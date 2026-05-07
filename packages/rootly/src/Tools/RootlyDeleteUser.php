<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an user.
 *
 * Maps to the official Rootly endpoint delete /v1/users/{id}.
 */
class RootlyDeleteUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_user';
    protected const DESCRIPTION = 'Delete an user

Official Rootly endpoint: DELETE /v1/users/{id}

Delete a specific user by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
