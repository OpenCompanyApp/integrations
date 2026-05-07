<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Lists linked accounts.
 *
 * Maps to the official Brex endpoint get /v1/linked_accounts.
 */
class BrexPaymentsListLinkedAccounts extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_list_linked_accounts';
    protected const DESCRIPTION = 'Lists linked accounts

Official Brex endpoint: GET /v1/linked_accounts

This endpoint lists all bank connections that are eligible to make ACH transfers to Brex business account';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/linked_accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
