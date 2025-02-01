<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI',
            ],

            'routes' => [
                /*
                 * Route for accessing API documentation interface
                 */
                'api' => 'api/documentation',
            ],

            'paths' => [
                /*
                 * Edit to include full URL in UI for assets
                 * Set to true if you need to load assets from an absolute path
                 */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                /*
                 * Path where Swagger UI assets should be stored
                 */
                'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

                /*
                 * File name of the generated JSON documentation file
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * File name of the generated YAML documentation file
                 */
                'docs_yaml' => 'api-docs.yaml',

                /*
                 * Set this to `json` or `yaml` to determine which documentation file to use in the UI
                 */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                /*
                 * Path to directory where swagger annotations are stored
                 */
                'annotations' => [
                    base_path('app'),  // Make sure the annotations path includes your source code
                ],
            ],
        ],
    ],
    'defaults' => [
        'routes' => [
            /*
             * Route for accessing parsed swagger annotations
             */
            'docs' => 'docs',

            /*
             * Route for OAuth2 authentication callback
             */
            'oauth2_callback' => 'api/oauth2-callback',

            /*
             * Middleware for protecting API documentation routes
             */
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],

            /*
             * Group options for routes
             */
            'group_options' => [],
        ],

        'paths' => [
            /*
             * Absolute path where parsed annotations will be stored
             */
            'docs' => storage_path('api-docs'),

            /*
             * Path to export Swagger UI views
             */
            'views' => base_path('resources/views/vendor/l5-swagger'),

            /*
             * Base path for the API
             */
            'base' => env('L5_SWAGGER_BASE_PATH', null),

            /*
             * Directories to exclude from scanning for annotations
             */
            'excludes' => [],
        ],

        'scanOptions' => [
            'default_processors_configuration' => [
                // Customize default processors if needed
            ],

            'analyser' => null,

            'analysis' => null,

            'processors' => [
                // Custom processors can be added here
            ],

            'pattern' => null,

            /*
             * Directories to exclude from scanning (overrides paths.excludes)
             */
            'exclude' => [],

            /*
             * OpenAPI specification version (can be 3.0.0 or 3.1.0)
             */
            'open_api_spec_version' => env('L5_SWAGGER_OPEN_API_SPEC_VERSION', \L5Swagger\Generator::OPEN_API_DEFAULT_SPEC_VERSION),
        ],

        'securityDefinitions' => [
            'securitySchemes' => [
                /*
                 * Define API security schemes here
                 * Examples: OAuth2, API keys
                 */
                // 'api_key_security_example' => [ ... ],
            ],
            'security' => [
                /*
                 * Define security settings for API routes
                 */
                // ['api_key_security_example' => []],
            ],
        ],

        /*
         * Regenerate Swagger docs on each request in development mode
         * Set to `false` for production
         */
        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),

        /*
         * Generate YAML copy of documentation
         */
        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),

        /*
         * Proxy settings for handling requests via proxies (e.g., AWS Load Balancer)
         */
        'proxy' => false,

        /*
         * Fetch external configuration for Swagger UI
         */
        'additional_config_url' => null,

        /*
         * Sorting for API operations
         * Options: 'alpha' (alphabetical), 'method' (by HTTP method)
         */
        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),

        /*
         * Swagger UI validation URL
         * Set to null to disable validation
         */
        'validator_url' => null,

        /*
         * Swagger UI configuration options
         */
        'ui' => [
            'display' => [
                'dark_mode' => env('L5_SWAGGER_UI_DARK_MODE', false),
                'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),
                'filter' => env('L5_SWAGGER_UI_FILTERS', true),
            ],

            'authorization' => [
                'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),
                'oauth2' => [
                    'use_pkce_with_authorization_code_grant' => false,
                ],
            ],
        ],

        /*
         * Constants for annotations
         */
        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://my-default-host.com'),
        ],
    ],
];
