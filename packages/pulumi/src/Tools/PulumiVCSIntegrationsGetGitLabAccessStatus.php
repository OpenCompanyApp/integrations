<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetGitLabAccessStatus.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/gitlab/access-status.
 */
class PulumiVCSIntegrationsGetGitLabAccessStatus extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_get_git_lab_access_status';
    protected const DESCRIPTION = 'GetGitLabAccessStatus

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/gitlab/access-status

Returns information about a user\'s GitLab access status for an organization, including whether they have a valid OAuth token, existing integrations, and available GitLab groups for new integrations.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/gitlab/access-status';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
