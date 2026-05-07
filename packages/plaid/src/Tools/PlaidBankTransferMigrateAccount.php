<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Migrate account into Bank Transfers.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/migrate_account.
 */
class PlaidBankTransferMigrateAccount extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_migrate_account';
    protected const DESCRIPTION = 'Migrate account into Bank Transfers

Official Plaid endpoint: POST /bank_transfer/migrate_account

As an alternative to adding Items via Link, you can also use the `/bank_transfer/migrate_account` endpoint to migrate known account and routing numbers to Plaid Items. Note that Items created in this way are not compatible with endpoints for other products, such as `/accounts/balance/get`, and can only be used with Bank Transfer endpoints. If you require access to other endpoints, create the Item through Link instead. Access to `/bank_transfer/migrate_account` is not enabled by default; to obtain access, contact your Plaid Account Manager.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/migrate_account';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}