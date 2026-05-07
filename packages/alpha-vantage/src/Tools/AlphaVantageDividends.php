<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for DIVIDENDS.
 */
class AlphaVantageDividends extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_dividends';
    protected const FUNCTION = 'DIVIDENDS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for DIVIDENDS.

Official Alpha Vantage function: DIVIDENDS.';
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
