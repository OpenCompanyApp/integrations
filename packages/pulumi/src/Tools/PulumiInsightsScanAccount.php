<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ScanAccount.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts/{accountName}/scan.
 */
class PulumiInsightsScanAccount extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_scan_account';
    protected const DESCRIPTION = 'ScanAccount

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts/{accountName}/scan

Starts a resource discovery scan for an Insights account. For parent accounts, triggers scans across all child accounts.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/scan';
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
