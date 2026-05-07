<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * StartGitHubSetup.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/integrations/github.
 */
class PulumiVCSIntegrationsStartGitHubSetup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_start_git_hub_setup';
    protected const DESCRIPTION = 'StartGitHubSetup

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/integrations/github

Initiates GitHub App setup, returns installation URL with state.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/github';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
