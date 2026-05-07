<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage equity market data for GLOBAL_QUOTE.
 */
class AlphaVantageGlobalQuote extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_global_quote';
    protected const FUNCTION = 'GLOBAL_QUOTE';
    protected const DESCRIPTION = 'Fetch Alpha Vantage equity market data for GLOBAL_QUOTE.

Official Alpha Vantage function: GLOBAL_QUOTE.';
    protected const REQUIRED = array (
  0 => 'symbol',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Equity symbol such as IBM or MSFT.',
  ),
  'datatype' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Response type.',
    'enum' =>
    array (
      0 => 'json',
      1 => 'csv',
    ),
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
