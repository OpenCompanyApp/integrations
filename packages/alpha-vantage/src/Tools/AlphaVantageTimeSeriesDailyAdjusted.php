<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage equity market data for TIME_SERIES_DAILY_ADJUSTED.
 */
class AlphaVantageTimeSeriesDailyAdjusted extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_time_series_daily_adjusted';
    protected const FUNCTION = 'TIME_SERIES_DAILY_ADJUSTED';
    protected const DESCRIPTION = 'Fetch Alpha Vantage equity market data for TIME_SERIES_DAILY_ADJUSTED.

Official Alpha Vantage function: TIME_SERIES_DAILY_ADJUSTED.';
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
  'outputsize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'compact or full output size where supported.',
    'enum' =>
    array (
      0 => 'compact',
      1 => 'full',
    ),
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
