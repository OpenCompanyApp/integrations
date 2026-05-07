<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a bank transfer.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/create.
 */
class PlaidBankTransferCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_create';
    protected const DESCRIPTION = 'Create a bank transfer

Official Plaid endpoint: POST /bank_transfer/create

Use the `/bank_transfer/create` endpoint to initiate a new bank transfer.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}