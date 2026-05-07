<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a permission.
 *
 * Maps to the official WorkOS endpoint get /authorization/permissions/{slug}.
 */
class WorkOSAuthorizationPermissionsFind extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_permissions_find';
    protected const DESCRIPTION = 'Get a permission

Official WorkOS endpoint: GET /authorization/permissions/{slug}

Retrieve a permission by its unique slug.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/permissions/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
