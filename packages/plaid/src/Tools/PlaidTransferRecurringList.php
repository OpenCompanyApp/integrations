<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List recurring transfers.
 *
 * Maps to the official Plaid endpoint post /transfer/recurring/list.
 */
class PlaidTransferRecurringList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_recurring_list';
    protected const DESCRIPTION = 'List recurring transfers

Official Plaid endpoint: POST /transfer/recurring/list

Use the `/transfer/recurring/list` endpoint to see a list of all your recurring transfers and their statuses. Results are paginated; use the `count` and `offset` query parameters to retrieve the desired recurring transfers.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/recurring/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}