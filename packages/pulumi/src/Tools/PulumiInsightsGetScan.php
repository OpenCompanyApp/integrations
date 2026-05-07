<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetScan.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/scans/{scanId}.
 */
class PulumiInsightsGetScan extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_get_scan';
    protected const DESCRIPTION = 'GetScan

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/scans/{scanId}

Returns details for a specific Insights scan, including its status, timestamps, and resource counts.';
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
  'scan_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scanId` from the official Pulumi Cloud API operation. The scan identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/scans/{scanId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
  'scanId' => 'scan_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
