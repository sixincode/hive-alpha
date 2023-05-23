<?php

// config for Sixincode/HiveAlpha
return [
  'name' => 'hiveAlpha',
  'identification' => 'hive-alpha',
  'models'  => [
      'login'      => Sixincode\HiveAlpha\Models\HiveLogin::class,
      'model'      => Sixincode\HiveAlpha\Models\HiveModel::class,
      'modelx'     => Sixincode\HiveAlpha\Models\HiveModelx::class,
      'user'       => App\Models\User::class,
  ],
  'table_names'  => [
      'logins'     => 'logins',
    ],
  'column_names'  => [
      'key_global'     => 'global',
      'key_user'       => 'user_global',
  ],
  'processes'  => [
      'activate_by_default'     => true,
      'global_by_default'       => true,
      'slug_by_default'         => true,
        // 'private_by_default'      => 'false',
  ],
  'cache'              => [
      'expiration_time'             => \DateInterval::createFromDateString('24 hours'),
      'key'                         => 'sixincode.hive-alpha.cache',
      'model_key'                   => 'name',
      'store'                       => 'default',
  ],
];
