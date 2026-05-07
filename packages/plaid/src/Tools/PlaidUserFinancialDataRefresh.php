<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh user items for Financial-Insights bundle.
 *
 * Maps to the official Plaid endpoint post /user/financial_data/refresh.
 */
class PlaidUserFinancialDataRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_user_financial_data_refresh';
    protected const DESCRIPTION = 'Refresh user items for Financial-Insights bundle

Official Plaid endpoint: POST /user/financial_data/refresh

`/user/financial_data/refresh` is an optional endpoint that initiates an on-demand extraction to fetch the newest transactions for a User using the Financial Insights bundle. This bundle refreshes the Transactions, Investments, and Liabilities product data. This endpoint is for clients who use the Transactions Insights bundle and want to proactively update all linked Items under a user. The refresh may succeed or fail on a per-Item basis. Use the `results` array in the response to understand the outcome for each Item. This endpoint is distinct from `/transactions/refresh`, which triggers a refresh for a single Item. Use `/user/financial_data/refresh` to target all Items for a user instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/financial_data/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}