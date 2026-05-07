<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List transfer events.
 *
 * Maps to the official Plaid endpoint post /transfer/event/list.
 */
class PlaidTransferEventList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_event_list';
    protected const DESCRIPTION = 'List transfer events

Official Plaid endpoint: POST /transfer/event/list

Use the `/transfer/event/list` endpoint to get a list of transfer events based on specified filter criteria.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/event/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}