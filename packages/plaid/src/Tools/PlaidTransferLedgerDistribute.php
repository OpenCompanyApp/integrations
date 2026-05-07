<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Move available balance between ledgers.
 *
 * Maps to the official Plaid endpoint post /transfer/ledger/distribute.
 */
class PlaidTransferLedgerDistribute extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_ledger_distribute';
    protected const DESCRIPTION = 'Move available balance between ledgers

Official Plaid endpoint: POST /transfer/ledger/distribute

Use the `/transfer/ledger/distribute` endpoint to move available balance between ledgers, if you have multiple. If you’re a platform, you can move funds between one of your ledgers and one of your customer’s ledger.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/ledger/distribute';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}