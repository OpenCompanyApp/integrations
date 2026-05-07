<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateScheduledScanSettings.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/preview/insights/{orgName}/accounts/{accountName}/scan/settings.
 */
class PulumiInsightsUpdateScheduledScanSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_update_scheduled_scan_settings';
    protected const DESCRIPTION = 'UpdateScheduledScanSettings

Official Pulumi Cloud endpoint: PUT /api/preview/insights/{orgName}/accounts/{accountName}/scan/settings

Updates the scheduled scan configuration for an Insights account, such as scan frequency and schedule.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/scan/settings';
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
