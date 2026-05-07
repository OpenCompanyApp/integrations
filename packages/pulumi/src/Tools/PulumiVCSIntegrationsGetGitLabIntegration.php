<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetGitLabIntegration.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/gitlab/{integrationId}.
 */
class PulumiVCSIntegrationsGetGitLabIntegration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_git_lab_integration';
    protected const DESCRIPTION = 'GetGitLabIntegration

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/gitlab/{integrationId}

Gets a specific GitLab integration by its integration ID. Returns the integration details including the linked GitLab group, authentication configuration, and validity status.';
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
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The GitLab integration identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/gitlab/{integrationId}';
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
