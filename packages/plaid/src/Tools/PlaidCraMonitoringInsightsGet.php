<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a Monitoring Insights Report.
 *
 * Maps to the official Plaid endpoint post /cra/monitoring_insights/get.
 */
class PlaidCraMonitoringInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_monitoring_insights_get';
    protected const DESCRIPTION = 'Retrieve a Monitoring Insights Report

Official Plaid endpoint: POST /cra/monitoring_insights/get

This endpoint allows you to retrieve a Cash Flow Updates report by passing in the `user_id` referred to in the webhook you received.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/monitoring_insights/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}