<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a User from SCIM data.
 *
 * Maps to the official FireHydrant endpoint put /v1/scim/v2/Users/{id}.
 */
class FireHydrantUpdateScimUser extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_scim_user';
    protected const DESCRIPTION = 'Update a User from SCIM data

Official FireHydrant endpoint: PUT /v1/scim/v2/Users/{id}

PUT SCIM endpoint to update a User. This endpoint is used to replace a resource\'s attributes.';
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
    protected const METHOD = 'put';
    protected const PATH = '/v1/scim/v2/Users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
