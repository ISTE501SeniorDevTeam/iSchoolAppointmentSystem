# API


### Deploy
after cloning, run  

    $ php composer.phar install  
to install dependencies

To initialize propel: 

    $ php vendor/bin/propel init
This will DELETE current config
during setup place Model files into a subdirectory a.e. /Models

To remove default models To rebuild Models 

    $rm -rf Models/*

To overwrite default schema provided by propel with our schema

    $mv schema.xml.bac schema.xml

To rebuild model files

    $ php vendor/bin/propel model:build

To rebuild SQL:

    $ php vendor/bin/propel sql:build --overwrite

To re-deploy SQL to DBMS:

    $ php vendor/bin/propel sql:insert
This will OVERRIDE any tables with the same name as the ones being created.
This will ERASE ALL CONTENTS of the tables being created.

To upload initial data:

    $ php initialize_db.php

### Regenerate documentation
    $ php phpdoc.phar
