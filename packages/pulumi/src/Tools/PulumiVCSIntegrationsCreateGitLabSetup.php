<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateGitLabSetup.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/console/orgs/{orgName}/integrations/gitlab.
 */
class PulumiVCSIntegrationsCreateGitLabSetup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_create_git_lab_setup';
    protected const DESCRIPTION = 'CreateGitLabSetup

Official Pulumi Cloud endpoint: POST /api/console/orgs/{orgName}/integrations/gitlab

Creates a new GitLab integration for an organization. Requires a GitLab group ID and optionally configures authentication via the user\'s GitLab OAuth token or a group access token. Returns 409 if an integration already exists for the specified group.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
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
