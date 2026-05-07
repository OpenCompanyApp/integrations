<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for OVERVIEW.
 */
class AlphaVantageOverview extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_overview';
    protected const FUNCTION = 'OVERVIEW';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for OVERVIEW.

Official Alpha Vantage function: OVERVIEW.';
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
