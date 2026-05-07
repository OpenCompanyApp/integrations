<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve the account associated with a processor token.
 *
 * Maps to the official Plaid endpoint post /processor/account/get.
 */
class PlaidProcessorAccountGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_account_get';
    protected const DESCRIPTION = 'Retrieve the account associated with a processor token

Official Plaid endpoint: POST /processor/account/get

This endpoint returns the account associated with a given processor token. This endpoint retrieves cached information, rather than extracting fresh information from the institution. As a result, the account balance returned may not be up-to-date; for realtime balance information, use `/processor/balance/get` instead. Note that some information is nullable.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/account/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}