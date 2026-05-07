<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetGitHubAccess.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/github/access-status.
 */
class PulumiVCSIntegrationsGetGitHubAccess extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_git_hub_access';
    protected const DESCRIPTION = 'GetGitHubAccess

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/github/access-status

Returns information about a user\'s GitHub OAuth status.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/github/access-status';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
