<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete an Organization Domain.
 *
 * Maps to the official WorkOS endpoint delete /organization_domains/{id}.
 */
class WorkOSOrganizationDomainsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organization_domains_delete';
    protected const DESCRIPTION = 'Delete an Organization Domain

Official WorkOS endpoint: DELETE /organization_domains/{id}

Permanently deletes an organization domain. It cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/organization_domains/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
