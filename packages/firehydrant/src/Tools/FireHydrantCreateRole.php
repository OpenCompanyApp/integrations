<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a role.
 *
 * Maps to the official FireHydrant endpoint post /v1/roles.
 */
class FireHydrantCreateRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_role';
    protected const DESCRIPTION = 'Create a role

Official FireHydrant endpoint: POST /v1/roles

Create a new role';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
