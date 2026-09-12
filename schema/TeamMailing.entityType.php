<?php
use CRM_MailingTeam_ExtensionUtil as E;

return [
  'name' => 'TeamMailing',
  'table' => 'civicrm_team_mailing',
  'class' => 'CRM_Team_DAO_TeamMailing',
  'getInfo' => fn() => [
    'title' => E::ts('Team Mailing'),
    'title_plural' => E::ts('Team Mailings'),
    'description' => E::ts('Relationship between a Team and Mailing, for restricted access permission.'),
    'log' => TRUE,
    'add' => '4.7',
  ],
  'getIndices' => fn() => [
    'UI_team_mailing' => [
      'fields' => [
        'team_id' => TRUE,
        'mailing_id' => TRUE,
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
      'description' => E::ts('Unique TeamMailing ID'),
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
    'mailing_id' => [
      'title' => E::ts('Mailing ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'EntityRef',
      'required' => TRUE,
      'description' => E::ts('FK to civicrm_mailing'),
      'add' => '4.7',
      'entity_reference' => [
        'entity' => 'Mailing',
        'key' => 'id',
        'on_delete' => 'CASCADE',
      ],
    ],
  ],
];
