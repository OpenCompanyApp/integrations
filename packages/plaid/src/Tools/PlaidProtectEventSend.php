<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Send a new event to enrich user data.
 *
 * Maps to the official Plaid endpoint post /protect/event/send.
 */
class PlaidProtectEventSend extends AbstractPlaidTool
{
    protected const NAME = 'plaid_protect_event_send';
    protected const DESCRIPTION = 'Send a new event to enrich user data

Official Plaid endpoint: POST /protect/event/send

Send a new event to enrich user data and optionally get a Trust Index score for the event.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/protect/event/send';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}