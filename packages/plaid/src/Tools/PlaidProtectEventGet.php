<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get information about a user event.
 *
 * Maps to the official Plaid endpoint post /protect/event/get.
 */
class PlaidProtectEventGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_protect_event_get';
    protected const DESCRIPTION = 'Get information about a user event

Official Plaid endpoint: POST /protect/event/get

Get information about a user event including Trust Index score and fraud attributes.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/protect/event/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}