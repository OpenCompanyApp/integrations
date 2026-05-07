<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetGitHubEnterpriseIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/github-enterprise/{integrationId}.
 */
class PulumiVCSIntegrationsGetGitHubEnterpriseIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_git_hub_enterprise_integration';
    protected const DESCRIPTION = 'GetGitHubEnterpriseIntegration

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/github-enterprise/{integrationId}

Gets a specific GitHub Enterprise Server integration.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The GitHub Enterprise integration identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/github-enterprise/{integrationId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'integrationId' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
