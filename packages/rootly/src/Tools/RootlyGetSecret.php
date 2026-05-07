<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a secret.
 *
 * Maps to the official Rootly endpoint get /v1/secrets/{id}.
 */
class RootlyGetSecret extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_secret';
    protected const DESCRIPTION = 'Retrieves a secret

Official Rootly endpoint: GET /v1/secrets/{id}

Retrieve a specific secret by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/secrets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
