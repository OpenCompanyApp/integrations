<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Recipient.
 *
 * Maps to the official Plaid endpoint get /fdx/recipient/{recipientId}.
 */
class PlaidGetRecipient extends AbstractPlaidTool
{
    protected const NAME = 'plaid_get_recipient';
    protected const DESCRIPTION = 'Get Recipient

Official Plaid endpoint: GET /fdx/recipient/{recipientId}

Get a specific recipient';
    protected const PARAMETERS = array (
  'recipientId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `recipientId` from the official Plaid API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/fdx/recipient/{recipientId}';
    protected const PATH_PARAMS = array (
  0 => 'recipientId',
);
    protected const BODY_REQUIRED = false;
}