<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],
        //CONFIGURACION TEST
        'gcs' => [
            'driver' => 'gcs',
            'key_file_path' => env('GOOGLE_CLOUD_KEY_FILE', null), // optional: /path/to/service-account.json
            'key_file' => [
                "type" => "service_account",
                "project_id" => "casapropia-test",
                "private_key_id" => "2fbefeef0508a232295347fbb52da3f8de66c16f",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCfJ/VtUAyTFSk6\nzuN9gtHxb0S/sO0ATY8oCkY4k/cFAlfLEn/ExbpqLlBT78BxnxRWizZMWJNMiO7s\nVX/mQDZswvokE7UimxuiNSkA6tiV6ZYlhbjHfzexpkVaUkHy9Rpdx/IunrSsX4pk\nwth8o+f3qAiXrnAGr3z3DArZOt1kZBSbYgoG0R7WWEROwswBkxoXkeTdDSQAeisf\nc+dE/nr+IN8wFf9xodsfP+Wgz43JOwCzetULIeR5P1IwReQr+MqjGCjRWUKrfjdJ\nouNaiZ0FC80poDx7Oyg5dfrtfNalBr+/VF3bzIn8ETPl3R42slau8xk2bCuygCZ9\nqHfEmDKpAgMBAAECggEAOAyyehS+2O2S34sMwp7XoNc2tutwC7NEvy0fHb2+OJ1i\nnbmeFYYs6Ef3Mhg1Bc6oMvJD5Q8skL+IpOJXcJcck6D2xs3J9K37RVzDW/dY3zKs\nFfrJ4DgFPSL5OZ3Oa+m1p2FLAPATYMEk0+dqpjpy7tzWadSczz3uHHK5P1djsH6f\n3K5OsZcfsNBPjkKIK7ABiZ7MUeRZY5JU7fuOW1RmActOs1zfP1MdM5M5fjv4ImaC\n9fYir8MEcONWfIEtqgModPSAseTaTIuNq+aOEPlFGqRU/jhoWCl3IO+jfbmH8EIB\nm6LcATWlZFL3D3pzdtPwgZoG4mZP0pY2zMQXsq6YoQKBgQDYksErjOIN5clGvjxT\ncHEIONuYdoF+k9fv2ZcFJd8N/6KFBO+p0N4VMd8+C571OgBv397kTF2ElrvANNBf\nWXFYwbstztmTj8xxBqMRdCmSDd4z9CAEhK9xMkJIpswuc2ILbCECh0Y84BX9CS7o\n27DPe7iVh3+x/1OhEmJJX+UKmwKBgQC8IVEl0fum/bD4yenfE04c8Zvg2KashiXo\nkYxaR+kEN+Pyt+6rNebcqG0FcrM7UTfYHqqpx9fwNoxcp4UF/CL4OT6SDeJPhndc\nwxXkoNB9vroR3Cx4BfcuQthtiS98KV6VS0Dv6nfaWnJY/3KifDMMr0B0SHdSHTvb\nXrr+2FcaCwKBgQChNGuRDSbejWJKxCOHQDUCl7/tNpihLU8Ye3BMJqpncxb3yHrU\nfmIwiJTRTDkf8/KLU6pHaQhbPw+1vBo2Pw99r4ayTDvr+KeGohgTT9H5o1T4ewiy\nFEm7ClwIVA+7q6sZMX1IsoR3n5z+Yi2GqrBrYH4+30MPrSwEwvhiAX0tbQKBgQCG\nA4HH3D5U5bEUeNkltJ3XVnFBCXQpv+HvOwdtJH6kJ6A0vbvBsMME+uG2mM9+eMu8\nI5RVH2v+zQzNz/OdoM/UXQrqhgNpvRL4PGwzEi+S87Oel2YCFdXP2YRM+wWdf+bF\nmPboMPEx1W5RYZ7qimjfJ1RVwW1mTDbgfSnd8oSRowKBgQC0bdVpuw+fJj+Q0FpR\nTfiaGOpfaRySFTGSo33Q8pxDW7rE+Mh/KGkMbTIHFk0mL7M5cJXGYBMWY1qplLgr\ncHKhZ0/idqnGw3p+ymxHzOWQWuE5LekabcquX3IHqpmUatIQj1/HcjQ93t7A8x4+\nEUbRpRSayPrbugVtv3c5SW9bOw==\n-----END PRIVATE KEY-----\n",
                "client_email" => "firebase-adminsdk-hl0b3@casapropia-test.iam.gserviceaccount.com",
                "client_id" => "116636141714296938028",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-hl0b3%40casapropia-test.iam.gserviceaccount.com",
                "universe_domain" => "googleapis.com"                
            ], // optional: Array of data that substitutes the .json file (see below)
            'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'casapropia-test'), // optional: is included in key file
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'casapropia-test.appspot.com'),
            'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', ''), // optional: /default/path/to/apply/in/bucket
            'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
            'api_endpoint' => env('GOOGLE_CLOUD_STORAGE_API_ENDPOINT', null), // set storageClient apiEndpoint
            'visibility' => 'public', // optional: public|private
            'visibility_handler' => null, // optional: set to \League\Flysystem\GoogleCloudStorage\UniformBucketLevelAccessVisibility::class to enable uniform bucket level access
            'metadata' => ['cacheControl' => 'public,max-age=86400'], // optional: default metadata
        ],
        //CONFIGURACION CON CUENTA DE CASAR PROPIA EN GOOGLE GRATIS 5G, LUEGO COMPRAR PLAN BLAZE 0.06 POR GB, es decir 100GB = 2.6 USD 
        // 'gcs' => [
        //     'driver' => 'gcs',
        //     'key_file_path' => env('GOOGLE_CLOUD_KEY_FILE', null), // optional: /path/to/service-account.json
        //     'key_file' => [
        //         "type"=> "service_account",
        //         "project_id"=> "casapropia-sgbr",
        //         "private_key_id"=> "e1f8210c04514292dcd86afe61cb38846c336818",
        //         "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCdl39diP5Rb5fZ\n6I+Tx7PKVuoCgmX7g7kcnW8PU4OWltvRHIfQUmVUFfxlxpGsQLquH2+qCaWiZjKi\nMW7UKIb0fPprrWPIOv9MpIRAhnnkxq8vuBLVMTXG68fcbcpqnV7zNWlCBI9YCkJT\nhjvpF57m0W7PpVIJSYyBeus3JaveT1XjYk8MEPEkUbKJkUK5nTzsCKrvev70vi7f\n2Av74Y0uPaLKAScvoqpimH3VowZFpBtzZK+ms2uK/nVs8XHoYRFNGVOAsRyIt9QI\nbAkNAedJYJz1STd5P055J0uNBJCxSh7VumsIo9/RMkHVTrXuqqSVNbaQJ0mEHeCU\nCmEStkpXAgMBAAECggEAFGnKiJSqu2S/oEKPepPci6IHgkIJhh4RbTiivrL8MWui\n11WhQrsG6htGTEP/nExELN2LQCorZ5END6pkkfHFTXJ07lwRjUnAcS6W/P65Al6O\n1G5nw3AyPZf5axRZAHIYbwY6TLVngKl6NEndL9EsoaHQ/0UJuS9AQTNpYtrWhkoU\nzuFGreTYmXRz6vQNtDRnQrymFEpocxc5QXmMfgU19v7xQ40hVNippBw1pulGCS8F\nTLI9vnhK69QyqcSmzZUd8CJs1x9BNv2YArmDozu4ge7T2bGFUM/taRwVW5ZaJDH6\n7u+p1mACRMa5NUBmUWvOi4AHOvCPqvxNQGwyriPayQKBgQDPttXa4w2H0GhWgyEV\nU+Av4jINcadCGGYuYJ5scb25YEmsfw5WwaJyxUVhPMb1H27r5AqGxz9vWEF9H2PY\n3KW4+YIJFD2UOzL8nlzVXYZInzFPZ5k/V5cFXtj1AHdTXVF9xMXFY+ZjRSzpxpB6\nbM9EVA8q6y6RkBIVU7kzQg+vrwKBgQDCOdrgvLEhehPZI/oYsUgASxLeGQQFOvaa\nOL8FBdWFw66+/JicXvaT5iVjHlUrnhYmkSFSgIK0YLj8Cxb05jMwkCx0GREeMj5U\n2+hrmPILpjWKryodvwUA9pirNQModBvgs/8iE47w+JKtCw+Q+uJ1a3o6CHFRzZ46\n0SNfsWxR2QKBgQDHdGboV8y/VKVMJYCYLUGCWW78r90PP8Sm1gpqUdH/9vDn3d2T\n+z4VfU6A786QxI1LoF9nSl6keZfxITpMnJvaAmUWeMQk2a+9GghErhjrFUpRWEa0\np1QSSSCGKttqRpqg7VmHkMVDH8Lf/NbxaBijISCrcsf16OUka4/UI6RSawKBgBZh\nlFdRZxf0eVUMUEWIKEPgYsw1FcGEieY7o8dwZKqFYh2f/fYG+2MPoj9Jv4bHMMZA\n8xYOuQEQJEDnBj4ySLPP6U93lAFmyMf+j0nW1g2BmanhhXjoCiuSPwV7lmGS/6Nl\nGoFSv6YE/uHx5FlQj8f4Gp2VW3mRuCoO74SXbWQBAoGAHUvXdrshLYTJEoR1VQXc\n8XTYxjH49vAnEK8WdFsu9EBqThP9PlmLTpz2S5i/Rpvur6e1lBgRe/3cQfbJUIrJ\nF6N3ctxe1vydbpUxtwzw0wBt/dJ3rekZlr0CDABajYzro6dKNrgF2127jlmzg9fQ\nrcXdt3nbNDG8BzBc07j6Sxo=\n-----END PRIVATE KEY-----\n",
        //         "client_email"=> "firebase-adminsdk-wlkbr@casapropia-sgbr.iam.gserviceaccount.com",
        //         "client_id"=> "104889461299749954002",
        //         "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
        //         "token_uri"=> "https://oauth2.googleapis.com/token",
        //         "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
        //         "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-wlkbr%40casapropia-sgbr.iam.gserviceaccount.com",
        //         "universe_domain"=> "googleapis.com"                
        //     ], // optional: Array of data that substitutes the .json file (see below)
        //     'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'casapropia-sgbr'), // optional: is included in key file
        //     'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'casapropia-sgbr.appspot.com'),
        //     'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', ''), // optional: /default/path/to/apply/in/bucket
        //     'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
        //     'api_endpoint' => env('GOOGLE_CLOUD_STORAGE_API_ENDPOINT', null), // set storageClient apiEndpoint
        //     'visibility' => 'public', // optional: public|private
        //     'visibility_handler' => null, // optional: set to \League\Flysystem\GoogleCloudStorage\UniformBucketLevelAccessVisibility::class to enable uniform bucket level access
        //     'metadata' => ['cacheControl' => 'public,max-age=86400'], // optional: default metadata
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
