<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a user.
 *
 * Maps to the official FireHydrant endpoint get /v1/users/{id}.
 */
class FireHydrantGetUser extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_user';
    protected const DESCRIPTION = 'Get a user

Official FireHydrant endpoint: GET /v1/users/{id}

Retrieve a single user by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
