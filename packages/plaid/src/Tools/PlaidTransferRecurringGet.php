<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a recurring transfer.
 *
 * Maps to the official Plaid endpoint post /transfer/recurring/get.
 */
class PlaidTransferRecurringGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_recurring_get';
    protected const DESCRIPTION = 'Retrieve a recurring transfer

Official Plaid endpoint: POST /transfer/recurring/get

The `/transfer/recurring/get` fetches information about the recurring transfer corresponding to the given `recurring_transfer_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/recurring/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}