<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a transfer.
 *
 * Maps to the official Plaid endpoint post /transfer/create.
 */
class PlaidTransferCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_create';
    protected const DESCRIPTION = 'Create a transfer

Official Plaid endpoint: POST /transfer/create

Use the `/transfer/create` endpoint to initiate a new transfer. This endpoint is retryable and idempotent; if a transfer with the provided `transfer_id` has already been created, it will return the transfer details without creating a new transfer. A transfer may still be created if a 500 error is returned; to detect this scenario, use [Transfer events](https://plaid.com/docs/transfer/reconciling-transfers/).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}