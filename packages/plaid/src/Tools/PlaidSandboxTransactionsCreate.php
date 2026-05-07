<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create sandbox transactions.
 *
 * Maps to the official Plaid endpoint post /sandbox/transactions/create.
 */
class PlaidSandboxTransactionsCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transactions_create';
    protected const DESCRIPTION = 'Create sandbox transactions

Official Plaid endpoint: POST /sandbox/transactions/create

Use the `/sandbox/transactions/create` endpoint to create new transactions for an existing Item. This endpoint can be used to add up to 10 transactions to any Item at a time. This endpoint can only be used with Items that were created in the Sandbox environment using the `user_transactions_dynamic` test user. You can use this to add transactions to test the `/transactions/get` and `/transactions/sync` endpoints.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transactions/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}