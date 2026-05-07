<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for SHARES_OUTSTANDING.
 */
class AlphaVantageSharesOutstanding extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_shares_outstanding';
    protected const FUNCTION = 'SHARES_OUTSTANDING';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for SHARES_OUTSTANDING.

Official Alpha Vantage function: SHARES_OUTSTANDING.';
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
