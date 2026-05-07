<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve network insights for the provided `access_tokens`.
 *
 * Maps to the official Plaid endpoint post /network_insights/report/get.
 */
class PlaidNetworkInsightsReportGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_network_insights_report_get';
    protected const DESCRIPTION = 'Retrieve network insights for the provided `access_tokens`

Official Plaid endpoint: POST /network_insights/report/get

This endpoint allows you to retrieve the Network Insights from a list of `access_tokens`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/network_insights/report/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}