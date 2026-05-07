<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Cancel a transfer.
 *
 * Maps to the official Plaid endpoint post /transfer/cancel.
 */
class PlaidTransferCancel extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_cancel';
    protected const DESCRIPTION = 'Cancel a transfer

Official Plaid endpoint: POST /transfer/cancel

Use the `/transfer/cancel` endpoint to cancel a transfer. A transfer is eligible for cancellation if the `cancellable` property returned by `/transfer/get` is `true`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/cancel';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}