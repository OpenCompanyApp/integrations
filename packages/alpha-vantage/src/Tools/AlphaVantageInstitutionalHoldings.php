<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for INSTITUTIONAL_HOLDINGS.
 */
class AlphaVantageInstitutionalHoldings extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_institutional_holdings';
    protected const FUNCTION = 'INSTITUTIONAL_HOLDINGS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for INSTITUTIONAL_HOLDINGS.

Official Alpha Vantage function: INSTITUTIONAL_HOLDINGS.';
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
