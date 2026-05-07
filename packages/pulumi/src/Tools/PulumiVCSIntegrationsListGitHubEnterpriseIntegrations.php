<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListGitHubEnterpriseIntegrations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/github-enterprise.
 */
class PulumiVCSIntegrationsListGitHubEnterpriseIntegrations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_git_hub_enterprise_integrations';
    protected const DESCRIPTION = 'ListGitHubEnterpriseIntegrations

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/github-enterprise

Lists all GitHub Enterprise Server integrations for an organization. Returns only self-hosted GitHub App installations.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/github-enterprise';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
