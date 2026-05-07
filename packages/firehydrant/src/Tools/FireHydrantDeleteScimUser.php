<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a User matching SCIM data.
 *
 * Maps to the official FireHydrant endpoint delete /v1/scim/v2/Users/{id}.
 */
class FireHydrantDeleteScimUser extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_scim_user';
    protected const DESCRIPTION = 'Delete a User matching SCIM data

Official FireHydrant endpoint: DELETE /v1/scim/v2/Users/{id}

SCIM endpoint to delete a User. This endpoint will deactivate a confirmed User record in our system.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/scim/v2/Users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
