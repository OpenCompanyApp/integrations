<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListVCSRepos.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/console/orgs/{orgName}/integrations/{provider}/{integrationId}/repos.
 */
class PulumiVCSIntegrationsListVCSRepos extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_vcs_integrations_list_vcsrepos';
    protected const DESCRIPTION = 'ListVCSRepos

Official Pulumi Cloud endpoint: GET /api/console/orgs/{orgName}/integrations/{provider}/{integrationId}/repos

Lists repositories available through the integration.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'provider' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `provider` from the official Pulumi Cloud API operation. The VCS provider (e.g., \'github\')',
    'enum' =>
    array (
      0 => 'github',
      1 => 'gitlab',
      2 => 'bitbucket',
      3 => 'azure_devops',
      4 => 'custom',
      5 => 'github_enterprise',
    ),
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integrationId` from the official Pulumi Cloud API operation. The VCS integration identifier',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page` from the official Pulumi Cloud API operation. Page number for pagination',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/console/orgs/{orgName}/integrations/{provider}/{integrationId}/repos';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'provider' => 'provider',
  'integrationId' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
