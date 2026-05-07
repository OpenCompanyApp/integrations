<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Obtain user insights based on transactions sent through /transactions/enrich.
 *
 * Maps to the official Plaid endpoint post /beta/transactions/user_insights/v1/get.
 */
class PlaidTransactionsUserInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_user_insights_get';
    protected const DESCRIPTION = 'Obtain user insights based on transactions sent through /transactions/enrich

Official Plaid endpoint: POST /beta/transactions/user_insights/v1/get

The `/beta/transactions/user_insights/v1/get` gets user insights for clients who have enriched data with `/transactions/enrich`. The product is currently in beta.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/transactions/user_insights/v1/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}