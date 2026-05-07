<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a CORS origin.
 *
 * Maps to the official WorkOS endpoint post /user_management/cors_origins.
 */
class WorkOSCorsOriginsCreateCorsOrigin extends AbstractWorkOSTool
{
    protected const NAME = 'workos_cors_origins_create_cors_origin';
    protected const DESCRIPTION = 'Create a CORS origin

Official WorkOS endpoint: POST /user_management/cors_origins

Creates a new CORS origin for the current environment. CORS origins allow browser-based applications to make requests to the WorkOS API.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/cors_origins';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
