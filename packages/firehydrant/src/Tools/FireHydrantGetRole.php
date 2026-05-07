<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a role.
 *
 * Maps to the official FireHydrant endpoint get /v1/roles/{id}.
 */
class FireHydrantGetRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_role';
    protected const DESCRIPTION = 'Get a role

Official FireHydrant endpoint: GET /v1/roles/{id}

Get a role';
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
