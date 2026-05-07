<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for EARNINGS.
 */
class AlphaVantageEarnings extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_earnings';
    protected const FUNCTION = 'EARNINGS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for EARNINGS.

Official Alpha Vantage function: EARNINGS.';
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
