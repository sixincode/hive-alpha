<?php

// config for Sixincode/HiveAlpha
return [
  'models'  => [
      'model'      => Sixincode\HiveAlpha\Models\HiveModel::class,
      'modelx'     => Sixincode\HiveAlpha\Models\HiveModelx::class,
  ],
  'column_names'  => [
      'key_global'     => 'global',
      'key_user'       => 'user_global',
      'state_active'   => 'is_active',
      // 'state_featured' => 'is_featured',
      // 'state_private'  => 'is_private',
      'slug_primary'   => 'slug',
      'sort_order'     => 'sort_order',
      'is_featured'    => 'is_featured',
      'is_private'     => 'is_private',
      'properties'     => 'properties',
      'data'           => 'data',
      'global'     => 'global',
  ],
  'processes'  => [
      'activate_by_default'     => true,
      'global_by_default'       => true,
      'slug_by_default'         => true,
        // 'private_by_default'      => 'false',
  ],
];
