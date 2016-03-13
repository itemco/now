<?php
    
/* My own db-class, hopefully better than the other one! */

class AD extends Config
{
  private $userinfo = [];

  public function __construct()
  {
    #session_start();
  }

  public function login($user, $pass) {
    fnDebug(__CLASS__."->".__FUNCTION__."", $user." : ********");
    try {
      $conn = ldap_connect("ldaps://".$this->ad_host);
      ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
      $bind = @ldap_bind($conn, $this->ad_prefix."".$user, $pass);
      
      if ($bind == TRUE) {
        $filter = "(sAMAccountName=$user)";
        $attr = array("mail","cn","sn","givenName","displayName","name","department","memberOf","telephoneNumber","l");
        $result = ldap_search($conn, $this->ad_dn, $filter, $attr);
        $ldap_entries = ldap_get_entries($conn, $result);
        #fnDebug("ldap_entries", $ldap_entries);
        ldap_unbind($conn);
        #now transform to a better array
        $userinfo["id"] = $user;
        $userinfo["full_name"] = $ldap_entries[0]["displayname"][0];
        $userinfo["first_name"] = $ldap_entries[0]["givenname"][0];
        $userinfo["last_name"] = $ldap_entries[0]["sn"][0];
        $userinfo["department"] = $ldap_entries[0]["department"][0];
        $userinfo["email"] = $ldap_entries[0]["mail"][0];
        $userinfo["phone"] = $ldap_entries[0]["telephonenumber"][0];
        $userinfo["location"] = $ldap_entries[0]["l"][0];
        #now add all groups
        foreach($ldap_entries[0]['memberof'] as $group) {
          $group = str_replace("CN=", "", $group);
          $split = explode(",", $group);
          $group = $split[0];
          $userinfo["groups"][] = $group;
        }
        $this->userinfo = $userinfo;
        return TRUE;
      } else {
        return FALSE;
      }
    } catch(Exception $e) {
      fnDebug("ERROR:", $e->getMessage());
      return FALSE;
    }
  }

  public function logout() {
    fnDebug(__CLASS__."->".__FUNCTION__."");
    #session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    $this->userinfo = [];
  }

  public function get_user_info() {
    fnDebug(__CLASS__."->".__FUNCTION__."", $this->userinfo);
    return $this->userinfo;
  }

}
?>

