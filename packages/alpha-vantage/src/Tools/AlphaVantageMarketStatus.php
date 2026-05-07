<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage global market open and closure status.
 */
class AlphaVantageMarketStatus extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_market_status';
    protected const FUNCTION = 'MARKET_STATUS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage global market open and closure status.

Official Alpha Vantage function: MARKET_STATUS.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
