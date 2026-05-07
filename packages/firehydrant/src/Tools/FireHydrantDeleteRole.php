<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a role.
 *
 * Maps to the official FireHydrant endpoint delete /v1/roles/{id}.
 */
class FireHydrantDeleteRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_role';
    protected const DESCRIPTION = 'Delete a role

Official FireHydrant endpoint: DELETE /v1/roles/{id}

Delete a role';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
