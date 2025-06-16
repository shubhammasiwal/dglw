<?php

return [
    'ROLES' => [
        'PORTAL_ADMIN' => 'portal_admin',
        'ADMIN' => 'admin',
        'WELFARE_COMMISSIONER' => 'welfare_commissioner',
        'DATA_OPERATOR' => 'data_operator',
    ],
    'LGD_STATE_TYPES' => [
        'STATE' => 'state',
        'UNION_TERRITORY' => 'union_territory',
    ],
    'LGD_STATE_TYPES_LABELS' => [
        'STATE' => 'State',
        'UNION_TERRITORY' => 'Union Territory',
    ],
    'LGD_STATE_TYPES_RADIO' => [
        'state' => 'State',
        'union_territory' => 'Union Territory',
    ],
    'CODE_DIRECTORY_TABLE_NAMES' => [
        'marital_statuses',
        'social_categories',
        'genders',
        'worker_relationships',
        'worker_types',
        'disabilities',
        'education',
        'migration_reasons',
        'address_types',

    ],

    'CODE_DIRECTORY_MODEL_NAMES' => [
        'marital_statuses' => 'MaritalStatus',
        'social_categories' => 'SocialCategory',
        'genders' => 'Gender',
        'worker_relationships' => 'WorkerRelationship',
        'worker_types' => 'WorkerType',
        'disabilities' => 'Disability',
        'education' => 'Education',
        'migration_reasons' => 'MigrationReason',
        'address_types' => 'AddressType',
    ],

];