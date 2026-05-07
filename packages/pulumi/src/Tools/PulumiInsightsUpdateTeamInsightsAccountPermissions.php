<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateTeamInsightsAccountPermissions.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/preview/insights/{orgName}/accounts/{accountName}/teams/{teamName}.
 */
class PulumiInsightsUpdateTeamInsightsAccountPermissions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_update_team_insights_account_permissions';
    protected const DESCRIPTION = 'UpdateTeamInsightsAccountPermissions

Official Pulumi Cloud endpoint: PATCH /api/preview/insights/{orgName}/accounts/{accountName}/teams/{teamName}

Updates the permissions that a team has on an Insights account.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'account_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accountName` from the official Pulumi Cloud API operation. The Insights account name',
  ),
  'team_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamName` from the official Pulumi Cloud API operation. The team name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/teams/{teamName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
  'teamName' => 'team_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
