<?php
use CRM_MailingTeam_ExtensionUtil as E;

return [
  'name' => 'TeamMailingFromAddress',
  'table' => 'civicrm_team_mailing_email',
  'class' => 'CRM_Team_DAO_TeamMailingFromAddress',
  'getInfo' => fn() => [
    'title' => E::ts('Team Mailing From Address'),
    'title_plural' => E::ts('Team Mailing From Addresses'),
    'description' => E::ts('Relationship between a Team and a "From Email Address" it can use.'),
    'log' => TRUE,
    'add' => '4.7',
  ],
  'getIndices' => fn() => [
    'UI_team_mailing_from_address_option_id' => [
      'fields' => [
        'team_id' => TRUE,
        'from_email_address_id' => TRUE,
      ],
      'unique' => TRUE,
      'add' => '4.7',
    ],
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique TeamMailingFromAddress ID'),
      'add' => '4.7',
      'primary_key' => TRUE,
      'auto_increment' => TRUE,
    ],
    'team_id' => [
      'title' => E::ts('Team ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'EntityRef',
      'required' => TRUE,
      'description' => E::ts('FK to civicrm_team'),
      'add' => '4.7',
      'entity_reference' => [
        'entity' => NULL,
        'key' => 'id',
        'on_delete' => 'CASCADE',
      ],
    ],
    'from_email_address_id' => [
      'title' => E::ts('From Email Address ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Select',
      'required' => TRUE,
      'description' => E::ts('From Email Address option value'),
      'add' => '4.7',
      'pseudoconstant' => [
        'option_group_name' => 'from_email_address',
      ],
    ],
  ],
];
