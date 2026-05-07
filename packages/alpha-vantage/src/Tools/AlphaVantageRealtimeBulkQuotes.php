<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage equity market data for REALTIME_BULK_QUOTES.
 */
class AlphaVantageRealtimeBulkQuotes extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_realtime_bulk_quotes';
    protected const FUNCTION = 'REALTIME_BULK_QUOTES';
    protected const DESCRIPTION = 'Fetch Alpha Vantage equity market data for REALTIME_BULK_QUOTES.

Official Alpha Vantage function: REALTIME_BULK_QUOTES.';
    protected const REQUIRED = array (
  0 => 'symbol',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Comma-separated equity symbols, up to the API limit.',
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
