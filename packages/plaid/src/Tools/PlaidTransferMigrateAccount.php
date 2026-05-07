<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Migrate account into Transfers.
 *
 * Maps to the official Plaid endpoint post /transfer/migrate_account.
 */
class PlaidTransferMigrateAccount extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_migrate_account';
    protected const DESCRIPTION = 'Migrate account into Transfers

Official Plaid endpoint: POST /transfer/migrate_account

As an alternative to adding Items via Link, you can also use the `/transfer/migrate_account` endpoint to migrate previously-verified account and routing numbers to Plaid Items. This endpoint is also required when adding an Item for use with wire transfers; if you intend to create wire transfers on this account, you must provide `wire_routing_number`. Note that Items created in this way are not compatible with endpoints for other products, such as `/accounts/balance/get`, and can only be used with Transfer endpoints. If you require access to other endpoints, create the Item through Link instead. Access to `/transfer/migrate_account` is not enabled by default; to obtain access, contact your...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/migrate_account';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}