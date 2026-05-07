<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage equity market data for TIME_SERIES_INTRADAY.
 */
class AlphaVantageTimeSeriesIntraday extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_time_series_intraday';
    protected const FUNCTION = 'TIME_SERIES_INTRADAY';
    protected const DESCRIPTION = 'Fetch Alpha Vantage equity market data for TIME_SERIES_INTRADAY.

Official Alpha Vantage function: TIME_SERIES_INTRADAY.';
    protected const REQUIRED = array (
  0 => 'symbol',
  1 => 'interval',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Equity symbol such as IBM or MSFT.',
  ),
  'interval' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Intraday interval.',
    'enum' =>
    array (
      0 => '1min',
      1 => '5min',
      2 => '15min',
      3 => '30min',
      4 => '60min',
    ),
  ),
  'adjusted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Whether intraday values should be adjusted for splits and dividends.',
  ),
  'extended_hours' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Include pre-market and post-market bars when available.',
  ),
  'month' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional month in YYYY-MM format for historical intraday slices.',
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
