<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get transfer product usage metrics.
 *
 * Maps to the official Plaid endpoint post /transfer/metrics/get.
 */
class PlaidTransferMetricsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_metrics_get';
    protected const DESCRIPTION = 'Get transfer product usage metrics

Official Plaid endpoint: POST /transfer/metrics/get

Use the `/transfer/metrics/get` endpoint to view your transfer product usage metrics. In the Sandbox environment, this endpoint returns static placeholder values rather than metrics computed from your Sandbox transfer activity.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/metrics/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}