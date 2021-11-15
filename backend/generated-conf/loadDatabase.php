<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Map\\AdTableMap',
    1 => '\\Map\\EmployeeTableMap',
    2 => '\\Map\\HourTableMap',
    3 => '\\Map\\ImageTableMap',
    4 => '\\Map\\MajorTableMap',
    5 => '\\Map\\ModalityTableMap',
    6 => '\\Map\\ReasonTableMap',
    7 => '\\Map\\RoleTableMap',
    8 => '\\Map\\StudentTableMap',
    9 => '\\Map\\TokenTableMap',
    10 => '\\Map\\VisitTableMap',
    11 => '\\Map\\WalkinHourTableMap',
  ),
));
