<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a recurring transfer.
 *
 * Maps to the official Plaid endpoint post /transfer/recurring/create.
 */
class PlaidTransferRecurringCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_recurring_create';
    protected const DESCRIPTION = 'Create a recurring transfer

Official Plaid endpoint: POST /transfer/recurring/create

Use the `/transfer/recurring/create` endpoint to initiate a new recurring transfer. This capability is not currently supported for Transfer UI or Transfer for Platforms (beta) customers.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/recurring/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}