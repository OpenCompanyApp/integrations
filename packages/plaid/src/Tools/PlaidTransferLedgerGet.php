<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Plaid Ledger balance.
 *
 * Maps to the official Plaid endpoint post /transfer/ledger/get.
 */
class PlaidTransferLedgerGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_ledger_get';
    protected const DESCRIPTION = 'Retrieve Plaid Ledger balance

Official Plaid endpoint: POST /transfer/ledger/get

Use the `/transfer/ledger/get` endpoint to view a balance on the ledger held with Plaid.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/ledger/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}