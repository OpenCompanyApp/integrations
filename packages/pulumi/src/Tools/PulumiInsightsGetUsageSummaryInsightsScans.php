<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetUsageSummaryInsightsScans.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/insights-scans/summary.
 */
class PulumiInsightsGetUsageSummaryInsightsScans extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_get_usage_summary_insights_scans';
    protected const DESCRIPTION = 'GetUsageSummaryInsightsScans

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/insights-scans/summary

Returns a summary of Insights scan usage for an organization, grouped by the specified time granularity.';
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
    'description' => 'Query parameter `granularity` from the official Pulumi Cloud API operation. Time granularity for grouping usage data. Valid values: \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\'. Hourly granularity is limited t...',
  ),
  'lookback_days' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `lookbackDays` from the official Pulumi Cloud API operation. Number of days to look back for usage data. Mutually exclusive with lookbackStart; exactly one must be provided.',
  ),
  'lookback_start' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `lookbackStart` from the official Pulumi Cloud API operation. Start of the lookback period as a Unix timestamp (seconds since epoch). Must be within the last year and in the past. Mutually exclusive ...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/insights-scans/summary';
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
