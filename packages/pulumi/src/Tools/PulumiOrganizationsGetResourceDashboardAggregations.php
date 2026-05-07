<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetResourceDashboardAggregations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/search/resources/dashboard.
 */
class PulumiOrganizationsGetResourceDashboardAggregations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_resource_dashboard_aggregations';
    protected const DESCRIPTION = 'GetResourceDashboardAggregations

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/search/resources/dashboard

GetResourceDashboardAggregations returns aggregated resource data for display on organization dashboard cards, including resource counts grouped by package and other dimensions.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/search/resources/dashboard';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
