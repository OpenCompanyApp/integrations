<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteGitHubIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/console/orgs/{orgName}/integrations/github/{integrationId}.
 */
class PulumiVCSIntegrationsDeleteGitHubIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_delete_git_hub_integration';
    protected const DESCRIPTION = 'DeleteGitHubIntegration

Official Pulumi Cloud endpoint: DELETE /api/console/orgs/{orgName}/integrations/github/{integrationId}

Removes a GitHub App integration.';
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
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The GitHub App integration identifier',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/github/{integrationId}';
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
