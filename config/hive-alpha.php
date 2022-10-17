<?php

// config for Sixincode/HiveAlpha
return [
  'name' => 'hiveAlpha',
  'identification' => 'hive-alpha',
  'models'  => [
      'model'      => Sixincode\HiveAlpha\Models\HiveModel::class,
      'modelx'     => Sixincode\HiveAlpha\Models\HiveModelx::class,
      'hive_user'  => Sixincode\HiveAlpha\Models\HiveUser::class,
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
