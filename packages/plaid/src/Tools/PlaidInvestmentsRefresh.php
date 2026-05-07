<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh investment data.
 *
 * Maps to the official Plaid endpoint post /investments/refresh.
 */
class PlaidInvestmentsRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_investments_refresh';
    protected const DESCRIPTION = 'Refresh investment data

Official Plaid endpoint: POST /investments/refresh

`/investments/refresh` is an optional endpoint for users of the Investments product. It initiates an on-demand extraction to fetch the newest investment holdings and transactions for an Item. This on-demand extraction takes place in addition to the periodic extractions that automatically occur one or more times per day for any Investments-enabled Item. If changes to investments are discovered after calling `/investments/refresh`, Plaid will fire webhooks: [`HOLDINGS: DEFAULT_UPDATE`](https://plaid.com/docs/api/products/investments/#holdings-default_update) if any new holdings are detected, and [`INVESTMENTS_TRANSACTIONS: DEFAULT_UPDATE`](https://plaid.com/docs/api/products/investments/#in...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/investments/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}