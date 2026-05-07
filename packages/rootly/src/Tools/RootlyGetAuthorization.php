<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an authorization.
 *
 * Maps to the official Rootly endpoint get /v1/authorizations/{id}.
 */
class RootlyGetAuthorization extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_authorization';
    protected const DESCRIPTION = 'Retrieves an authorization

Official Rootly endpoint: GET /v1/authorizations/{id}

Retrieves a specific authorization by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/authorizations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
