<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Cancel a bank transfer.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/cancel.
 */
class PlaidBankTransferCancel extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_cancel';
    protected const DESCRIPTION = 'Cancel a bank transfer

Official Plaid endpoint: POST /bank_transfer/cancel

Use the `/bank_transfer/cancel` endpoint to cancel a bank transfer. A transfer is eligible for cancelation if the `cancellable` property returned by `/bank_transfer/get` is `true`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/cancel';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}