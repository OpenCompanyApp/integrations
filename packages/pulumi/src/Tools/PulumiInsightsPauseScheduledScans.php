<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PauseScheduledScans.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts/{accountName}/scan/pause.
 */
class PulumiInsightsPauseScheduledScans extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_pause_scheduled_scans';
    protected const DESCRIPTION = 'PauseScheduledScans

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts/{accountName}/scan/pause

PauseScheduledScans pauses execution of future scheduled scans for an Insights account.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/scan/pause';
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
