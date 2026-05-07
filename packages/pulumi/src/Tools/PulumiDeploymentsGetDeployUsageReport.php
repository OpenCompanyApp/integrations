<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDeployUsageReport.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/deployments/usagereport.
 */
class PulumiDeploymentsGetDeployUsageReport extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_deploy_usage_report';
    protected const DESCRIPTION = 'GetDeployUsageReport

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/deployments/usagereport

Retrieves raw deployment usage records for self-hosted Pulumi Cloud customers to self-report deployment consumption. Returns aggregated deployment usage records for the specified organization. The \'lookbackDays\' query parameter controls how far back in time to retrieve records. This endpoint is primarily used by self-hosted customers for usage reporting and billing reconciliation purposes.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'lookback_days' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `lookbackDays` from the official Pulumi Cloud API operation. Number of days to look back',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/deployments/usagereport';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'lookbackDays' => 'lookback_days',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
