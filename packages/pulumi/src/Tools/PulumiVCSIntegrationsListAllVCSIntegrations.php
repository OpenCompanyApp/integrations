<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAllVCSIntegrations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations.
 */
class PulumiVCSIntegrationsListAllVCSIntegrations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_all_vcsintegrations';
    protected const DESCRIPTION = 'ListAllVCSIntegrations

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations

Returns a summary of all VCS integrations across all providers (GitHub, GitLab, Azure DevOps, Custom) for an organization. Each integration includes a hasIndividualAccess flag indicating whether the current user has an OAuth token for that provider.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
