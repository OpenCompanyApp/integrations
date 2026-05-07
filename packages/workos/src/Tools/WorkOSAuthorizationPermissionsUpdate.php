<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a permission.
 *
 * Maps to the official WorkOS endpoint patch /authorization/permissions/{slug}.
 */
class WorkOSAuthorizationPermissionsUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_permissions_update';
    protected const DESCRIPTION = 'Update a permission

Official WorkOS endpoint: PATCH /authorization/permissions/{slug}

Update an existing permission. Only the fields provided in the request body will be updated.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/authorization/permissions/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
