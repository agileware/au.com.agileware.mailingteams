<?php

class CRM_MailingTeam_APIWrapper implements API_Wrapper {
  public static $option_value_id = NULL;

  public function fromAPIInput($apiRequest) {
    if(($apiRequest['entity'] == 'Group' || $apiRequest['entity'] == 'Mailing') &&
      ($apiRequest['action'] == 'getlist')) {
      CRM_Team_BAO_TeamMailingGroup::$doAclCheck++;
      unset($apiRequest['params']['params']['forMailing']);
    }

    elseif($apiRequest['entity'] == 'OptionValue' && $apiRequest['action'] == 'get') {
      self::$option_value_id = array(
        "head"  => self::$option_value_id,
        "value" => $apiRequest['params']['option_group_id']
      );
    }

    return $apiRequest;
  }

  public function toApiOutput($apiRequest, $result){
    if(($apiRequest['entity'] == 'Group' || $apiRequest['entity'] == 'Mailing') &&
      ($apiRequest['action'] == 'getlist') && (CRM_Team_BAO_TeamMailingGroup::$doAclCheck > 0)) {
      CRM_Team_BAO_TeamMailingGroup::$doAclCheck--;
    }

    elseif($apiRequest['entity'] == 'OptionValue') {
      self::$option_value_id = self::$option_value_id['head'] ?? NULL;

      if(array_key_exists('option_group_id', $apiRequest['params']) && _mailingteams_fea_id($apiRequest['params']['option_group_id'])) {
        $result['values'] = array_filter(
          $result['values'], function($v){
            return CRM_Team_BAO_Team::checkPermissions('from_email_address', $v['value']);
          }
        );

        $result['count'] = count($result['values']);
      }
    }

    return $result;
  }
}
