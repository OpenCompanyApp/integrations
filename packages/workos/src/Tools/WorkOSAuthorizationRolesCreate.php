<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an environment role.
 *
 * Maps to the official WorkOS endpoint post /authorization/roles.
 */
class WorkOSAuthorizationRolesCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_roles_create';
    protected const DESCRIPTION = 'Create an environment role

Official WorkOS endpoint: POST /authorization/roles

Create a new environment role.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/authorization/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
