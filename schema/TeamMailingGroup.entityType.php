<?php
use CRM_MailingTeam_ExtensionUtil as E;

return [
  'name' => 'TeamMailingGroup',
  'table' => 'civicrm_team_mailing_group',
  'class' => 'CRM_Team_DAO_TeamMailingGroup',
  'getInfo' => fn() => [
    'title' => E::ts('Team Mailing Group'),
    'title_plural' => E::ts('Team Mailing Groups'),
    'description' => E::ts('FIXME'),
    'log' => TRUE,
    'add' => '4.7',
  ],
  'getIndices' => fn() => [
    'UI_team_group_role' => [
      'fields' => [
        'team_id' => TRUE,
        'group_id' => TRUE,
        'role' => TRUE,
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
      'description' => E::ts('Unique TeamMailingGroup ID'),
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
    'group_id' => [
      'title' => E::ts('Group ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'EntityRef',
      'required' => TRUE,
      'description' => E::ts('FK to Contact'),
      'add' => '4.7',
      'entity_reference' => [
        'entity' => 'Group',
        'key' => 'id',
        'on_delete' => 'CASCADE',
      ],
    ],
    'role' => [
      'title' => E::ts('Role'),
      'sql_type' => 'varchar(64)',
      'input_type' => 'Text',
      'description' => E::ts('Roles the team performs with the Mailing.'),
      'add' => '4.7',
    ],
  ],
];
