<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Sync transfer events.
 *
 * Maps to the official Plaid endpoint post /transfer/event/sync.
 */
class PlaidTransferEventSync extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_event_sync';
    protected const DESCRIPTION = 'Sync transfer events

Official Plaid endpoint: POST /transfer/event/sync

`/transfer/event/sync` allows you to request up to the next 500 transfer events that happened after a specific `event_id`. Use the `/transfer/event/sync` endpoint to guarantee you have seen all transfer events.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/event/sync';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}