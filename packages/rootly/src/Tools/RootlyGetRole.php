<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a role.
 *
 * Maps to the official Rootly endpoint get /v1/roles/{id}.
 */
class RootlyGetRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_role';
    protected const DESCRIPTION = 'Retrieves a role

Official Rootly endpoint: GET /v1/roles/{id}

Retrieves a specific role by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
