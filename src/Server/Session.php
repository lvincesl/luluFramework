<?php
namespace Luluframework\Server;

class Session
{
    public function __construct()
    {
        session_start();
    }

    /**
	 * Authentifie un utilisateur Active Directory
	 *
	 * @param string $adUsername Nom d'utilisateur
	 * @param string $adpassword Mot de passe
	 *
	 * @author Lionel Vinceslas <lionel.vinceslas@groupeseen.com>
	 * @date 20/09/2013
	 * @return bool
	 */
	public function ad_authentication($adUsername, $adpassword) {
		$log = new Logger('vf_site::ad_authentication()');
		$log->pushHandler(new StreamHandler('log/pem.log', Logger::DEBUG));

		try {
			$config = [
				'account_suffix' => '@groupeseen.local',
				'domain_controllers' => ['10.10.10.2'],
				'port' => 389,
				'base_dn' => 'dc=groupeseen,dc=local',
				'admin_username' => 'phpAdUser',
				'admin_password' => 'phpAdUser',
				'follow_referrals' => true,
				'use_ssl' => false,
				'use_tls' => false,
				'use_sso' => false,
			];

			$adldap = new \Adldap\Adldap($config);
		}
		catch (adLDAPException $e) {
			$log->error("Unable to join AD : $e", array('username' => $adUsername));
			return false;
		}
		
		try {

			$r = $adldap->authenticate($adUsername, $adpassword);

			if ($r) {

				$query =    "   SELECT CONCAT(prenom,' ',nom) as lesalarie, nom, prenom, id_salarie, idsociete, societe, email_groupe
								FROM vue_salaries_presents
								WHERE LOWER(CONCAT(prenom,' ',nom)) = LOWER(\"$adUsername\") 
								ORDER BY date_entree DESC, id_salarie DESC;";

				$result = vf_site::$model->query($query);
				if ($row = $result->fetch()) {
					$query =    "   SELECT role
									FROM utilisateur 
									WHERE idsalarie = ".$row['id_salarie'];

					$result = vf_site::$model->query($query);
					if ($row2 = $result->fetch()) {
						$_SESSION['user_role']      = $row2['role'];
					}
					else {
						$_SESSION['user_role']      = "Utilisateur authentifié";
					}

					$_SESSION['user_id']            = $row['id_salarie'];
					$_SESSION['user_name']          = $row['lesalarie'];
					$_SESSION['user_company_id']    = $row['idsociete'];
					$_SESSION['user_company_name']  = $row['societe'];
					$_SESSION['user_email']         = $row['email_groupe'];
					
					$log->info("User logged in", array('username' => $_SESSION['user_name'], 'role' => $_SESSION['user_role']));
					return true;
				}
				else {
					$query =    "   SELECT CONCAT(prenom,' ',nom) as lesalarie, nom, prenom, id_salarie, idsociete, societe, email_groupe, role
									FROM utilisateur 
									LEFT JOIN vue_salaries_presents ON utilisateur.idsalarie = vue_salaries_presents.id_salarie
									WHERE LOWER(ad_user_name) = LOWER(\"$adUsername\");";
					
					$result = vf_site::$model->query($query);
					if ($row = $result->fetch()) {
						$_SESSION['user_id']            = $row['id_salarie'];
						$_SESSION['user_name']          = (strlen($row['lesalarie'])?$row['lesalarie']:$adUsername);
						$_SESSION['user_company_id']    = $row['idsociete'];
						$_SESSION['user_company_name']  = $row['societe'];
						$_SESSION['user_email']         = $row['email_groupe'];
						$_SESSION['user_role']          = $row['role'];
						
						$log->info("User logged in", array('username' => $_SESSION['user_name'], 'role' => $_SESSION['user_role']));
						return true;
					}
					else {
						$log->info("Unknow user in HIRS", array('username' => $adUsername));
						return false;
					}
				}

			}
			else {
				$log->info("User authentication failed", array('username' => $adUsername));
				return false;
			}
		}
		catch (adLDAPException $e) {
			$log->error("User authentication failed : $e", array('username' => $adUsername));
			return false;
		}

		return true;
	}

	/**
	 * Authentification de l'utilisateur
	 *
	 * @return void
	 */
	public function start_authentification() {
		if (isset($_POST['username'])) { 
			if (!vf_site::ad_authentication($_POST['username'], $_POST['password'])) {
				vf_site::set_message('danger', "<i class='fa fa-exclamation' aria-hidden='true'></i>&nbsp; <strong>L'authentification a échouée.</strong> Veuillez resaisir vos identifiants ou contacter l'administrateur.");
			}
			else {
				vf_site::set_message('success', "<i class='fa fa-unlock' aria-hidden='true'></i>&nbsp; Connecté(e).</strong>");
			}
		}
		elseif (isset($_POST['dec'])) { 
			vf_site::session_stop();
		}
		
		if (isset($_SESSION['user_name'])) {
			$panel = new lvincesl\html\Html_template('html/auth/logued.html');
			$panel->set('USER_NAME', $_SESSION['user_name']);
			vf_site::$authentication_panel = $panel->toString();
		}
		else {
			$panel = new lvincesl\html\Html_template('html/auth/unlogued.html');
			$panel->set('LOGIN', $_POST['username']);
			$panel->set('PASSWORD', $_POST['password']);
			vf_site::$authentication_panel = $panel->toString();
		}
	}
}