<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Balance data.
 *
 * Maps to the official Plaid endpoint post /processor/balance/get.
 */
class PlaidProcessorBalanceGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_balance_get';
    protected const DESCRIPTION = 'Retrieve Balance data

Official Plaid endpoint: POST /processor/balance/get

The `/processor/balance/get` endpoint returns the real-time balance for each of an Item\'s accounts. While other endpoints may return a balance object, only `/processor/balance/get` forces the available and current balance fields to be refreshed rather than cached.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/balance/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}