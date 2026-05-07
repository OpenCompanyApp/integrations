<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetScanLogs.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/insights/{orgName}/accounts/{accountName}/scans/{scanId}/logs.
 */
class PulumiInsightsGetScanLogs extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_get_scan_logs';
    protected const DESCRIPTION = 'GetScanLogs

Official Pulumi Cloud endpoint: GET /api/preview/insights/{orgName}/accounts/{accountName}/scans/{scanId}/logs

Returns log output for a specific Insights scan. Supports two modes: when the \'job\' parameter is provided, returns step-level logs with job/step offsets; otherwise, uses continuationToken and count for paginated log retrieval.';
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
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results. Used when the \'job\' parameter is not provided.',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Number of log entries to return (must be between 1 and 500). Used when the \'job\' parameter is not provided.',
  ),
  'job' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `job` from the official Pulumi Cloud API operation. When provided, switches to step-based log retrieval. Specifies the job number whose step logs to fetch.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `offset` from the official Pulumi Cloud API operation. Byte offset within the step\'s log output. Used with the \'job\' and \'step\' parameters.',
  ),
  'step' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `step` from the official Pulumi Cloud API operation. Step number within the specified job. Used with the \'job\' parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/scans/{scanId}/logs';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'accountName' => 'account_name',
  'scanId' => 'scan_id',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'count' => 'count',
  'job' => 'job',
  'offset' => 'offset',
  'step' => 'step',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
