<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Subscribe to Monitoring Insights.
 *
 * Maps to the official Plaid endpoint post /cra/monitoring_insights/subscribe.
 */
class PlaidCraMonitoringInsightsSubscribe extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_monitoring_insights_subscribe';
    protected const DESCRIPTION = 'Subscribe to Monitoring Insights

Official Plaid endpoint: POST /cra/monitoring_insights/subscribe

This endpoint allows you to subscribe to insights for a user\'s linked CRA Item, which are updated between one and four times per day (best-effort). In the current Cash Flow Updates beta experience, only one Item per user may be subscribed for monitoring updates.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/monitoring_insights/subscribe';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}