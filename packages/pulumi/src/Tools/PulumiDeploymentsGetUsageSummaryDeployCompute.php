<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetUsageSummaryDeployCompute.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/deployments/summary.
 */
class PulumiDeploymentsGetUsageSummaryDeployCompute extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_usage_summary_deploy_compute';
    protected const DESCRIPTION = 'GetUsageSummaryDeployCompute

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/deployments/summary

Retrieves a summary of Pulumi Deployments compute usage (deployment minutes) for an organization. The response provides aggregated deployment minute consumption over the specified time period. Use the \'granularity\' parameter to control time bucketing (e.g. \'daily\' or \'hourly\'), and either \'lookbackDays\' (number of days from the current date) or \'lookbackStart\' (a Unix timestamp) to define the reporting window. Returns 204 No Content if no usage data is available for the specified period.';
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
    'description' => 'Query parameter `granularity` from the official Pulumi Cloud API operation. Time granularity for the summary (e.g. \'daily\', \'hourly\')',
  ),
  'lookback_days' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `lookbackDays` from the official Pulumi Cloud API operation. Number of days to look back from the current date',
  ),
  'lookback_start' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `lookbackStart` from the official Pulumi Cloud API operation. Start of the lookback period (Unix timestamp)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/deployments/summary';
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
