<?php
return array(


    /*
    |--------------------------------------------------------------------------
    | Keep TXT Files
    |--------------------------------------------------------------------------
    |
    | Keep extracted txt files from zip files (normal txt files stay in either case
    | On the expense of storage space, you wont need re-unzip gbyte sized files if you
    | are importing same data again and again...|
    |
    */
    'keepTxt' => true,

    /*
    |--------------------------------------------------------------------------
    | Storage Path
    |--------------------------------------------------------------------------
    |
    | This is the path to downloaded files and temporary files
    |
    */
    'storagePath' => storage_path() . '/meta/geonames',


    /*
    |--------------------------------------------------------------------------
    | Do Not Import / Ignore Tables
    |--------------------------------------------------------------------------
    |
    | Array of tables to ignore in imports. Some tables are not very necessary.
    | For example alternate_names table. Uncommenting it will stop auto-import.
    |
    | Notices:
    | * The database tables will still be created, but will stay empty.
    | * You can still import tables using the --table=TABLENAME option in geonames:seed command
    | * This wont remove already downloaded files (but will ignore the related ones)
    | * If you ignore geonames_geonames, you also have to ignore tables which has foreign key
    |   relationships. Please check the migration files.
    |
    */
    'ignoreTables' => array(
//        'geonames_feature_codes',
//        'geonames_timezones',
//        'geonames_geonames',
//        'geonames_hierarchies',
//        'geonames_country_infos',
//        'geonames_iso_language_codes',
//        'geonames_admin1_codes',
//        'geonames_admin2_codes',
        'geonames_alternate_names',
    ),

    /*
    |--------------------------------------------------------------------------
    | Country list for seeding
    |--------------------------------------------------------------------------
    | The countries to seed into geonames_geonames table.
    | Use the ISO code of the country.
    | If the list is empty, allCountries file is seeded
    |
    | Notice: The file XX.zip must exist in http://download.geonames.org/export/dump/
    */
    'countries' => array(
//        'FI',
//        'SE',
//        'NO'
    ),
);
