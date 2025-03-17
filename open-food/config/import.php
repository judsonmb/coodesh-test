<?php

return [
    'import_schedule' => [
        'hour' => 3,
        'minute' => 0,
    ],
    
    'import_limit_per_file' => 100,

    'files_url' => 'https://challenges.coode.sh/food/data/json/index.txt',

    'json_base_url' => 'https://challenges.coode.sh/food/data/json/',
    
    'import_history_table' => 'product_import_histories',
];
