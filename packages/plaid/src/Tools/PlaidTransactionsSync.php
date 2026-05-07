<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get incremental transaction updates on an Item.
 *
 * Maps to the official Plaid endpoint post /transactions/sync.
 */
class PlaidTransactionsSync extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_sync';
    protected const DESCRIPTION = 'Get incremental transaction updates on an Item

Official Plaid endpoint: POST /transactions/sync

The `/transactions/sync` endpoint retrieves transactions associated with an Item and can fetch updates using a cursor to track which updates have already been seen. For important instructions on integrating with `/transactions/sync`, see the [Transactions integration overview](https://plaid.com/docs/transactions/#integration-overview). If you are migrating from an existing integration using `/transactions/get`, see the [Transactions Sync migration guide](https://plaid.com/docs/transactions/sync-migration/). This endpoint supports `credit`, `depository`, and some `loan`-type accounts (only those with account subtype `student`). For `investments` accounts, use `/investments/transactions/get...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transactions/sync';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}