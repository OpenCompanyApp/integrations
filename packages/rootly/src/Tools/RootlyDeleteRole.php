<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a role.
 *
 * Maps to the official Rootly endpoint delete /v1/roles/{id}.
 */
class RootlyDeleteRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_role';
    protected const DESCRIPTION = 'Delete a role

Official Rootly endpoint: DELETE /v1/roles/{id}

Delete a specific role by id';
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
