<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListGitLabIntegrations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/gitlab.
 */
class PulumiVCSIntegrationsListGitLabIntegrations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_git_lab_integrations';
    protected const DESCRIPTION = 'ListGitLabIntegrations

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/gitlab

Lists all GitLab integrations configured for an organization, including their validity status and linked group metadata.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/gitlab';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
