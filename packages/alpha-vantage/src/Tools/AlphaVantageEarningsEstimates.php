<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for EARNINGS_ESTIMATES.
 */
class AlphaVantageEarningsEstimates extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_earnings_estimates';
    protected const FUNCTION = 'EARNINGS_ESTIMATES';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for EARNINGS_ESTIMATES.

Official Alpha Vantage function: EARNINGS_ESTIMATES.';
    protected const REQUIRED = array (
  0 => 'symbol',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Equity or ETF symbol.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
