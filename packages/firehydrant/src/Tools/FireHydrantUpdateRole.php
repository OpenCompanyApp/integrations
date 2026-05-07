<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a role.
 *
 * Maps to the official FireHydrant endpoint patch /v1/roles/{id}.
 */
class FireHydrantUpdateRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_role';
    protected const DESCRIPTION = 'Update a role

Official FireHydrant endpoint: PATCH /v1/roles/{id}

Update a role';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
