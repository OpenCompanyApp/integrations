<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Investment Holdings.
 *
 * Maps to the official Plaid endpoint post /processor/investments/holdings/get.
 */
class PlaidProcessorInvestmentsHoldingsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_investments_holdings_get';
    protected const DESCRIPTION = 'Retrieve Investment Holdings

Official Plaid endpoint: POST /processor/investments/holdings/get

This endpoint returns the stock position data of the account associated with a given processor token.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/investments/holdings/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}