<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a User from SCIM data.
 *
 * Maps to the official FireHydrant endpoint post /v1/scim/v2/Users.
 */
class FireHydrantCreateScimUser extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_scim_user';
    protected const DESCRIPTION = 'Create a User from SCIM data

Official FireHydrant endpoint: POST /v1/scim/v2/Users

SCIM endpoint to create and provision a new User. This endpoint will provision the User, which allows them to accept their account throught their IDP or via the Forgot Password flow.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/scim/v2/Users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
