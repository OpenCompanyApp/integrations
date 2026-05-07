<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Cancel a refund.
 *
 * Maps to the official Plaid endpoint post /transfer/refund/cancel.
 */
class PlaidTransferRefundCancel extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_refund_cancel';
    protected const DESCRIPTION = 'Cancel a refund

Official Plaid endpoint: POST /transfer/refund/cancel

Use the `/transfer/refund/cancel` endpoint to cancel a refund. A refund is eligible for cancellation if it has not yet been submitted to the payment network.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/refund/cancel';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}