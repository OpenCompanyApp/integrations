<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListInsightsAccountTeams.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/teams.
 */
class PulumiInsightsListInsightsAccountTeams extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_list_insights_account_teams';
    protected const DESCRIPTION = 'ListInsightsAccountTeams

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/teams

Returns the teams that have been granted access to an Insights account.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/teams';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
