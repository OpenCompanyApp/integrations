<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetUsageSummaryDiscoveredResourceHours.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/discovered-resources/summary.
 */
class PulumiOrganizationsGetUsageSummaryDiscoveredResourceHours extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_usage_summary_discovered_resource_hours';
    protected const DESCRIPTION = 'GetUsageSummaryDiscoveredResourceHours

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/discovered-resources/summary

GetUsageSummaryDiscoveredResourceHours handles request to fetch the summary of discovered resources for an organization.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'granularity' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `granularity` from the official Pulumi Cloud API operation. Time granularity for aggregation (e.g., \'hourly\', \'daily\', \'monthly\')',
  ),
  'lookback_days' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `lookbackDays` from the official Pulumi Cloud API operation. Number of days to look back from the current time or lookbackStart',
  ),
  'lookback_start' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `lookbackStart` from the official Pulumi Cloud API operation. Unix timestamp for the start of the lookback period (defaults to current time if omitted)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/discovered-resources/summary';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'granularity' => 'granularity',
  'lookbackDays' => 'lookback_days',
  'lookbackStart' => 'lookback_start',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
