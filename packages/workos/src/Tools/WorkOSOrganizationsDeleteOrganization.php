<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete an Organization.
 *
 * Maps to the official WorkOS endpoint delete /organizations/{id}.
 */
class WorkOSOrganizationsDeleteOrganization extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organizations_delete_organization';
    protected const DESCRIPTION = 'Delete an Organization

Official WorkOS endpoint: DELETE /organizations/{id}

Permanently deletes an organization in the current environment. It cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/organizations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
