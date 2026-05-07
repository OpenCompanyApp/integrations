<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Cancel a recurring transfer..
 *
 * Maps to the official Plaid endpoint post /transfer/recurring/cancel.
 */
class PlaidTransferRecurringCancel extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_recurring_cancel';
    protected const DESCRIPTION = 'Cancel a recurring transfer.

Official Plaid endpoint: POST /transfer/recurring/cancel

Use the `/transfer/recurring/cancel` endpoint to cancel a recurring transfer. Scheduled transfer that hasn\'t been submitted to bank will be cancelled.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/recurring/cancel';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}