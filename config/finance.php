<?php

declare(strict_types=1);

return [
    'connection' => env('INTRANET_CONNECTION', 'intranet'),

    'tables' => [
        'branch' => env('INTRANET_TABLE_EMPLOYEE', 'public.com_branch'),

        'employee' => env('INTRANET_TABLE_EMPLOYEE', 'public.sdm_employee'),

        'disbursement' => env('INTRANET_TABLE_DISBURSEMENT', 'finance.disbursement'),

        'disbursement_detail' => env('INTRANET_TABLE_DISBURSEMENT_DETAIL', 'finance.disbursement_detail'),

        'disbursement_type' => env('INTRANET_TABLE_DISBURSEMENT_TYPE', 'finance.disbursement_type'),

        'disbursement_category' => env('INTRANET_TABLE_DISBURSEMENT_CATEGORY', 'finance.disbursement_category'),
    ],
];
