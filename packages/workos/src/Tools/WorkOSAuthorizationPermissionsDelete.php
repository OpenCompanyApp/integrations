<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a permission.
 *
 * Maps to the official WorkOS endpoint delete /authorization/permissions/{slug}.
 */
class WorkOSAuthorizationPermissionsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_permissions_delete';
    protected const DESCRIPTION = 'Delete a permission

Official WorkOS endpoint: DELETE /authorization/permissions/{slug}

Delete an existing permission. System permissions cannot be deleted.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
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
