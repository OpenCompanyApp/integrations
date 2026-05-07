<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a SCIM user.
 *
 * Maps to the official FireHydrant endpoint get /v1/scim/v2/Users/{id}.
 */
class FireHydrantGetScimUser extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_scim_user';
    protected const DESCRIPTION = 'Get a SCIM user

Official FireHydrant endpoint: GET /v1/scim/v2/Users/{id}

SCIM endpoint that lists a User';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
