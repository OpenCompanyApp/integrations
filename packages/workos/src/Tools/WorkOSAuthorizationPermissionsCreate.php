<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a permission.
 *
 * Maps to the official WorkOS endpoint post /authorization/permissions.
 */
class WorkOSAuthorizationPermissionsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_permissions_create';
    protected const DESCRIPTION = 'Create a permission

Official WorkOS endpoint: POST /authorization/permissions

Create a new permission in your WorkOS environment. The permission can then be assigned to environment roles and custom roles.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/authorization/permissions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
