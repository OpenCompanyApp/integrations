<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh transaction data.
 *
 * Maps to the official Plaid endpoint post /processor/transactions/refresh.
 */
class PlaidProcessorTransactionsRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_transactions_refresh';
    protected const DESCRIPTION = 'Refresh transaction data

Official Plaid endpoint: POST /processor/transactions/refresh

`/processor/transactions/refresh` is an optional endpoint for users of the Transactions product. It initiates an on-demand extraction to fetch the newest transactions for a processor token. This on-demand extraction takes place in addition to the periodic extractions that automatically occur one or more times per day for any Transactions-enabled processor token. If changes to transactions are discovered after calling `/processor/transactions/refresh`, Plaid will fire a webhook: for `/transactions/sync` users, [`SYNC_UPDATES_AVAILABLE`](https://plaid.com/docs/api/products/transactions/#sync_updates_available) will be fired if there are any transactions updated, added, or removed. For users...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/transactions/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}