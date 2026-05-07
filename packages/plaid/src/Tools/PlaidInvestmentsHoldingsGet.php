<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Investment holdings.
 *
 * Maps to the official Plaid endpoint post /investments/holdings/get.
 */
class PlaidInvestmentsHoldingsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_investments_holdings_get';
    protected const DESCRIPTION = 'Get Investment holdings

Official Plaid endpoint: POST /investments/holdings/get

The `/investments/holdings/get` endpoint allows developers to receive user-authorized stock position data for `investment`-type accounts.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/investments/holdings/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}