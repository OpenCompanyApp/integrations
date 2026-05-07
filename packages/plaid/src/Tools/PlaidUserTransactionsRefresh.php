<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh user items for Transactions bundle.
 *
 * Maps to the official Plaid endpoint post /user/transactions/refresh.
 */
class PlaidUserTransactionsRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_transactions_refresh';
    protected const DESCRIPTION = 'Refresh user items for Transactions bundle

Official Plaid endpoint: POST /user/transactions/refresh

`/user/transactions/refresh` is an optional endpoint that initiates an on-demand extraction to fetch the newest transactions for a User using the Transactions bundle. This bundle refreshes only the Transactions product data. This endpoint is for clients who use the Transactions Insights bundle and want to proactively update all linked Items under a user. The refresh may succeed or fail on a per-Item basis. Use the `results` array in the response to understand the outcome for each Item. This endpoint is distinct from `/transactions/refresh`, which triggers a refresh for a single Item. Use `/user/transactions/refresh` to target all Items for a user instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/transactions/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}