<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Unsubscribe from Monitoring Insights.
 *
 * Maps to the official Plaid endpoint post /cra/monitoring_insights/unsubscribe.
 */
class PlaidCraMonitoringInsightsUnsubscribe extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_monitoring_insights_unsubscribe';
    protected const DESCRIPTION = 'Unsubscribe from Monitoring Insights

Official Plaid endpoint: POST /cra/monitoring_insights/unsubscribe

This endpoint allows you to unsubscribe from previously subscribed Monitoring Insights.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/monitoring_insights/unsubscribe';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}