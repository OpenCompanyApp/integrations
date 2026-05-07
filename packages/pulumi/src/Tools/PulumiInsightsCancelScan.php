<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CancelScan.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/insights/{orgName}/accounts/{accountName}/scan/cancel.
 */
class PulumiInsightsCancelScan extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_insights_cancel_scan';
    protected const DESCRIPTION = 'CancelScan

Official Pulumi Cloud endpoint: POST /api/preview/insights/{orgName}/accounts/{accountName}/scan/cancel

Cancels a running resource discovery scan for an Insights account.';
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
    protected const PATH = '/api/preview/insights/{orgName}/accounts/{accountName}/scan/cancel';
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
