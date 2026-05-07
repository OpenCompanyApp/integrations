<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateGitHubIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/console/orgs/{orgName}/integrations/github/{integrationId}.
 */
class PulumiVCSIntegrationsUpdateGitHubIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_update_git_hub_integration';
    protected const DESCRIPTION = 'UpdateGitHubIntegration

Official Pulumi Cloud endpoint: PATCH /api/console/orgs/{orgName}/integrations/github/{integrationId}

Updates GitHub App integration settings.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
