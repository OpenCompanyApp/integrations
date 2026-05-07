<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an authorization.
 *
 * Maps to the official Rootly endpoint delete /v1/authorizations/{id}.
 */
class RootlyDeleteAuthorization extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_authorization';
    protected const DESCRIPTION = 'Delete an authorization

Official Rootly endpoint: DELETE /v1/authorizations/{id}

Delete a specific authorization by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
