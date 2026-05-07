<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a bank transfer.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/get.
 */
class PlaidBankTransferGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_get';
    protected const DESCRIPTION = 'Retrieve a bank transfer

Official Plaid endpoint: POST /bank_transfer/get

The `/bank_transfer/get` fetches information about the bank transfer corresponding to the given `bank_transfer_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}