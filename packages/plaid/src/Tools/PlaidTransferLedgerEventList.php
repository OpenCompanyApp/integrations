<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List transfer ledger events.
 *
 * Maps to the official Plaid endpoint post /transfer/ledger/event/list.
 */
class PlaidTransferLedgerEventList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_ledger_event_list';
    protected const DESCRIPTION = 'List transfer ledger events

Official Plaid endpoint: POST /transfer/ledger/event/list

Use the `/transfer/ledger/event/list` endpoint to get a list of ledger events for a specific ledger based on specified filter criteria.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/ledger/event/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}