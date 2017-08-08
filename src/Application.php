<?php
namespace Luluframework;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Luluframework\Server\Log;
use Luluframework\Server\Router;
use Luluframework\Client\View\Breadcrumb;


class Application
{

	protected static $view 			= null;
	protected static $breadcrumb 	= null;
	protected static $css 			= null;
	protected static $js 			= null;
	protected static $onload_script = null;
	protected static $document_root = null;
	protected static $authentication_panel 	= null;
	
	protected $routes 	= null;
	protected $url 		= null;

	public static $model 			= null;
	public static $config 			= null;

	public function __construct()
	{

	}



	public static function get_authentication_panel() {
		return self::$authentication_panel;
	}
	
	public static function routing($routes_map_file=null) {
		// create a server request object
		$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
			$_SERVER,
			$_GET,
			$_POST,
			$_COOKIE,
			$_FILES
		);

		// create the router continer and get the routing map
		$routerContainer    = new Aura\Router\RouterContainer();
		$map                = $routerContainer->getMap();

		include_once $routes_map_file;

		// get the route matcher from the container ...
		$matcher = $routerContainer->getMatcher();

		// .. and try to match the request to a route.
		$route = $matcher->match($request);
		if (! $route) {
			$error = new lvincesl\html\Html_template('html/404.html');
			$error->show();
			exit;
		}

		// add route attributes to the request
		foreach ($route->attributes as $key => $val) {
			$request = $request->withAttribute($key, $val);
		}


		// dispatch the request to the route handler.
		// (consider using https://github.com/auraphp/Aura.Dispatcher
		// in place of the one callable below.)
		global $response;
		$callable = $route->handler;
		$response = $callable($request, $response);
	}

	/**
	 * Désauthentifie un utilisateur Active Directory
	 *
	 * @author Lionel Vinceslas <lionel.vinceslas@groupeseen.com>
	 * @date 20/09/2013
	 * @return bool
	 */
	public static function session_stop() {
		$log = new Logger('self::session_stop()');
		$log->pushHandler(new StreamHandler('log/pem.log', Logger::DEBUG));				
		$log->info("User logged out", array('username' => $_SESSION['user_name'], 'role' => $_SESSION['user_role']));
		session_unset();
		self::set_message('success', "<i class='fa fa-check' aria-hidden='true'></i>&nbsp; Fin de session.");
		return true;
	}

	/**
	 * Définittion de la VUE
	 *
	 * @param string $html_path
	 * @return void
	 */
	public static function set_view($html_path) {
		self::$view = new lvincesl\html\Html_template($html_path);
	}

	/**
	 * Mise à jour de la VUE
	 *
	 * @param string $tag
	 * @param string $value
	 * @return void
	 */
	public static function update_view($tag, $value) {
		self::$view->set($tag, $value);
	}

	/**
	 * Ajoute une entrée au fil d'ariane
	 *
	 * @param string $name
	 * @param string $link
	 * @return void
	 */
	public static function breadcrumb_add($name, $link = null) {
		if (!is_object(self::$breadcrumb)) self::$breadcrumb = new vf_breadcrumb();
		self::$breadcrumb->add_Item($name, $link);
	} 

	public static function set_config($config_file) {
		self::$config = parse_ini_file($config_file);
	}

	/**
	 * Démmare le site web
	 *
	 * @return void
	 */
	public static function start() {
		self::$model = null;
		if (!is_object(self::$breadcrumb)) self::$breadcrumb = new vf_breadcrumb();
		self::update_view('PAGE_CONTENT'      	 , $GLOBALS['response']->getBody());
		self::update_view('BREADCRUMB'            , self::$breadcrumb->get_Html());
		self::update_view('ATTACHED_CSS'          , self::get_attached_css());
		self::update_view('ATTACHED_JS'           , self::get_attached_js());
		self::update_view('ATTACHED_ONLOAD_SCRIPT', self::get_attached_onload_script());
		self::update_view('DOCUMENT_ROOT'         , self::$document_root);

		// emit the response
		foreach ($GLOBALS['response']->getHeaders() as $name => $values) {
			foreach ($values as $value) {
				header(sprintf('%s: %s', $name, $value), false);
			}
		}
		self::$view->show();
	}

	/**
	 * Définit le MODELE
	 *
	 * @param string $db_host
	 * @param string $db_name
	 * @param string $db_user
	 * @param string $db_password
	 * @return void
	 */
	public static function set_modele($db_host, $db_name, $db_user, $db_password) {
		try {
		    $strConnection = "mysql:host=$db_host;dbname=$db_name";
		    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		    self::$model = new PDO($strConnection, $db_user, $db_password, $arrExtraParam);
		    self::$model->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
		    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		    die($msg);
		}
	}

	public static function set_document_root($value) {
		self::$document_root = $value;
	}

	public static function get_document_root() {
		return self::$document_root;
	}

	/**
	 * Retourne une pagination HTML
	 *
	 * @param string $link         URL à lancer lors d'un clic sur la pagination
	 * @param string $current_page Numéro de page par actuel
	 * @param string $total_page   Nombre total de page
	 *
	 * @author Lionel Vinceslas
	 * @date 26/09/2013
	 * @return string
	 */
	public static function get_pagination($link, $current_page, $total_page)
	{
	    if ($total_page>1) {
	        $amplitude = 5;
	        $borne_inf = max(1, $current_page-$amplitude);
	        $borne_sup = min($total_page, $current_page+$amplitude+($borne_inf-($current_page-$amplitude)));
	        $pagination="<ul class='pagination pagination-sm'>";

	        if ($current_page == 1) {
	        	$pagination .= "<li class='disabled'><span data-toggle='tooltip' title='Première page'><i class='fa fa-angle-double-left' aria-hidden='true'></i></span></li>
	        					<li class='disabled'><span data-toggle='tooltip' title='Page précédente'><i class='fa fa-angle-left' aria-hidden='true'></i></span></li>";
	        }
	        else {
	        	$pagination .= "<li><a href='#' onclick='$.redirect(\"$link\",{ page: 1});' data-toggle='tooltip' title='Première page'><i class='fa fa-angle-double-left' aria-hidden='true'></i></a></li>
	                            <li><a href='#' onclick='$.redirect(\"$link\",{ page: ".max($current_page-1, 1)."});' data-uk-tooltip title='Page précédente'>
	                            	<i class='fa fa-angle-left' aria-hidden='true'></i>
	                            </a></li>\n";
	        }

	        for ($i=$borne_inf;$i<=$borne_sup;$i++) {
	        	if ($current_page==$i) {
	            	$pagination .= "<li class='active'><span>$i</span></li>\n";
	        	}
	        	else {
	            $pagination .= "<li><a href='#' onclick='$.redirect(\"$link\",{ page: \"$i\"});' data-toggle='tooltip' title='Page $i'>$i</a></li>\n";
	        	}
	        }

	       	if ($current_page == $total_page) {
	       		$pagination .= "<li class='disabled'><span data-toggle='tooltip' title='Page suivante'><i class='fa fa-angle-right' aria-hidden='true'></i></li>
	       						<li class='disabled'><span data-toggle='tooltip' title='Dernière page'><i class='fa fa-angle-double-right' aria-hidden='true'></i></li>";
	       	}
	       	else {
	       		$pagination .= "<li><a href='#' onclick='$.redirect(\"$link\",{ page: ".min($current_page+1, $total_page)."});' data-toggle='tooltip' title='Page suivante'>
	       							<i class='fa fa-angle-right' aria-hidden='true'></i></a>
	                        	</li>
	                        	<li><a href='#' onclick='$.redirect(\"$link\",{ page: $total_page});' data-toggle='tooltip' title='Dernière page'>
	                            	<i class='fa fa-angle-double-right' aria-hidden='true'></i></a>
	                        	</li>";
	       	}
	        return  $pagination.'</ul>';
	    } else return "";
	}

	public static function debug($info) {
		echo '## DEBUG ## '.$info;
		exit(0);
	}

	public static function get_mysql_date($frenchDate) {
		return implode('-', array(explode('/', $frenchDate)[2], explode('/', $frenchDate)[1], explode('/', $frenchDate)[0]));
	}

	public static function set_message($message_type, $message_text) {
		$_SESSION['message']['type'] = $message_type;
		$_SESSION['message']['text'] = $message_text;
	}

	public static function get_message() {
		if (isset($_SESSION['message'])) {
			$message = "<div class='alert alert-".$_SESSION['message']['type']."' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
  						".$_SESSION['message']['text']."</div>";
			unset($_SESSION['message']);
			return $message;
		}
		else return null;

	}

	/**
	 * Register a filter
	 *
	 * @param string $filter_id
	 * @param mixed $data
	 * @param string $placeholder
	 * @param string $all_placeholder
	 * @param string $type
	 * @return void
	 */
	public static function add_filter($filter_id, $data, $placeholder, $all_placeholder = "Tout", $type = "dropdown") {

		if (!isset($_SESSION['filters'][$filter_id])) {
			$_SESSION['filters'][$filter_id]['data'] = $data;
			$_SESSION['filters'][$filter_id]['placeholder'] = $placeholder;
			$_SESSION['filters'][$filter_id]['all_placeholder'] = $all_placeholder;
			$_SESSION['filters'][$filter_id]['type'] = $type;
			$_SESSION['filters'][$filter_id]['value'] = null;
		}
		elseif (isset($_POST[$filter_id])) {
			if ($_POST[$filter_id] == '*') $_POST[$filter_id] = null;
			if ($type == "dropdown") {
				self::update_filter_value($filter_id, $_POST[$filter_id]);
			}
			elseif ($type == "datepicker") {
				self::update_filter_value($filter_id, $_POST[$filter_id]!=''?self::get_mysql_date($_POST[$filter_id]):null);
			}
		}
	}

	/**
	 * Get filters html code
	 *
	 * @param Array $array
	 * @param string $style
	 * @return void
	 */
	public static function get_filters($array = null, $style='select2') {
		$filters_id = ($array?$array:array_keys($_SESSION['filters']));
		$filters_dropdown = null;
		$filters_datepicker = null;
		foreach ($filters_id as $key => $value) {
			
			if ($_SESSION['filters'][$value]['type'] == 'dropdown') {
				if (is_string($_SESSION['filters'][$value]['data'])) {
					$data = self::$model->query($_SESSION['filters'][$value]['data'])->fetchAll();
				}
				elseif (is_array($_SESSION['filters'][$value]['data'])) {
					$data = $_SESSION['filters'][$value]['data'];
				}
				else {
					$data = null;
				}
				if ($style == 'sumoselect') {
					$script = "$('#$value').SumoSelect({
								search: true,
								placeholder: \"".$_SESSION['filters'][$value]['placeholder']."\",
								captionFormat: '{0} Sélectionnés',
								captionFormatAllSelected: '".$_SESSION['filters'][$value]['all_placeholder']." ({0})',
								csvDispCount: 4,
								locale :  ['OK', 'Annulé', 'Sélectionner tout'],
								okCancelInMulti: true,
								selectAll: true
								});";
					self::attach_css(self::get_document_root().'bower_components/sumoselect/sumoselect.css');
					self::attach_js(self::get_document_root().'bower_components/sumoselect/jquery.sumoselect.min.js');
				}
				elseif ($style == 'select2') {
					$script = "$('#$value').select2({
								placeholder: \"".$_SESSION['filters'][$value]['placeholder']."\",
								width: 'relative',
								dropdownAutoWidth: true,
								allowClear: true
								});";
					self::attach_css(self::get_document_root().'bower_components/select2/dist/css/select2.min.css');
					self::attach_js(self::get_document_root().'bower_components/select2/dist/js/select2.min.js');
					self::attach_js(self::get_document_root().'bower_components/select2/dist/js/i18n/fr.js');
				}
				$actionLink = "onchange='$.redirect(\"".self::get_url()."\",{ $value: (($(\"#$value\").val()==\"\")?\"*\":$(\"#$value\").val())});'";
				if (isset($_POST[$value])) $_SESSION['filters'][$value]['value'] = $_POST[$value];
				$default_value = (is_array($_SESSION['filters'][$value]['value'])?$_SESSION['filters'][$value]['value']:explode(",", $_SESSION['filters'][$value]['value']));

				self::attach_onload_script($script);
				$filters_dropdown .= "<div class='input-group' data-toggle='tooltip' title=\"".$_SESSION['filters'][$value]['placeholder']."\"><select name=\"$value\" id=\"$value\" multiple $actionLink>";

				foreach ($data as $row) {
					$filters_dropdown .= "<option value=\"".$row['id']."\" ".(array_search($row['id'], $default_value)!==false?"selected":null).">".$row['option']."</option>";
				}
				$filters_dropdown .= '</select></div>';
			}
			elseif ($_SESSION['filters'][$value]['type'] == 'datepicker') {
				$actionLink = "onchange='$.redirect(\"".self::get_url()."\",{".$value.": (($(\"#$value\").val()==\"\")?\"*\":$(\"#$value\").val())})'";
				$defaultDate = $_SESSION['filters'][$value]['value'];
				$filters_datepicker .= "
				<div class='input-group'>
				<div class='input-group date' data-provide='datepicker' >
					<input type='text' data-toggle='tooltip' title=\"".$_SESSION['filters'][$value]['placeholder']."\" placeholder=\"".$_SESSION['filters'][$value]['placeholder']."\" class='form-control input-sm' name='$value' id='$value' $actionLink value='".(is_null($defaultDate)?'':implode('/', array(explode('-', $defaultDate)[2], explode('-', $defaultDate)[1], explode('-', $defaultDate)[0])))."'>
					<div class='input-group-addon input-sm'>
						<i class='fa fa-calendar' aria-hidden='true'></i>
					</div>
				</div></div>";
			}
		}

		return "$filters_dropdown$filters_datepicker";
	}

	public static function get_filter_clause() {

	}

	/**
	 * Return a HTML date picker
	 *
	 * @param string $name
	 * @param string $default_value
	 * @param string $placeholder
	 * @param string $tooltip
	 * @return void
	 */
	public static function get_date_picker($name, $default_value, $placeholder="Date", $tooltip="Choisissez une date") {

		return "
		<div class='input-group date' data-provide='datepicker' data-date-format='dd/mm/yyyy' id='$name'>
			<input type='text' data-toggle='tooltip' title=\"$tooltip\" placeholder=\"$placeholder\" class='form-control input-sm' name='$name' value='".(is_null($default_value)?'':implode('/', array(explode('-', $default_value)[2], explode('-', $default_value)[1], explode('-', $default_value)[0])))."'>
			<div class='input-group-addon input-sm'>
				<i class='fa fa-calendar' aria-hidden='true'></i>
			</div>
		</div>";

	}

	/**
	 * Return a HTML year picker
	 *
	 * @param string $name
	 * @param string $default_value
	 * @param string $placeholder
	 * @param string $tooltip
	 * @return void
	 */
	public static function get_year_picker($name, $default_value, $placeholder="Année", $tooltip="Choisissez une année") {

		return "
		<div class='input-group date' data-provide='datepicker' data-date-format='yyyy' id='$name'>
			<input type='text' data-toggle='tooltip' title=\"$tooltip\" placeholder=\"$placeholder\" class='form-control input-sm' name='$name' value='$default_value'>
			<div class='input-group-addon input-sm'>
				<i class='fa fa-calendar' aria-hidden='true'></i>
			</div>
		</div>";

	}

	/**
	 * Return a HTML combo box using parameters
	 *
	 * @param string $name
	 * @param string $default_value
	 * @param string $placeholder
	 * @param string $tooltip
	 * @param mixed  $data_source
	 * @return void
	 */
	public static function get_combo_box($name, $default_value, $placeholder=null, $tooltip=null, $data_source=null) {
		
		if (is_string($data_source)) {
			$data = self::$model->query($data_source)->fetchAll();
		}
		elseif (is_array($data_source)) {
			$data = $data_source;
		}
		else {
			$data = null;
		}

		$combo_box = "<select class='js-example-basic-single' id='$name' name='$name'><option></option>\n";

		foreach ($data as $item) {
			$combo_box .="<option value='".$item['id']."' ".(isset($item['tooltip'])?"title='".$item['tooltip']."'":null)." ".(($default_value==$item['id'])?"selected":"").">".$item['value']."</option>\n";
		}

		self::attach_onload_script("$(\"#$name\").select2({\n
														placeholder: \"$placeholder\",\n
														width: '100%',\n
														dropdownAutoWidth: true,\n
														allowClear: true\n
													});\n");

		return $combo_box."</select>";

	}

	public static function get_filter_value($filter_id) {
		return $_SESSION['filters'][$filter_id]['value'];
	}

	public static function update_filter_value($filter_id, $filter_value) {
		//debug($filter_value);
		$_SESSION['filters'][$filter_id]['value'] = $filter_value;
	}
	
	public static function attach_css($css_src) {
		self::$css .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$css_src\">\n";
	}

	public static function get_attached_css() {
		return self::$css;
	}

	public static function attach_js($js_src) {
		self::$js .= "<script src=\"$js_src\"></script>\n";
	}

	public static function get_attached_js() {
		return self::$js;
	}

	public static function attach_onload_script($script) {
		self::$onload_script .= "$script\n";
	}

	public static function get_attached_onload_script() {
		$html = "<script>\n$(document).ready(function(){\n".self::$onload_script."});\n</script>";
		return $html;
	}
}