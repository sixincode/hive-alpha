<?php

declare(strict_types=1);

// TABLES CHECK

if(function_exists('tableUsers')) {
  function tableUsers()
  {
    return config('hive-alpha.table_names.users');
  }
}

if(function_exists('tableLogins')) {
  function tableLogins()
  {
    return config('hive-alpha.table_names.logins');
  }
}
