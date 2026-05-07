<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage technical indicator data for HT_DCPHASE.
 */
class AlphaVantageHtDcphase extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_ht_dcphase';
    protected const FUNCTION = 'HT_DCPHASE';
    protected const DESCRIPTION = 'Fetch Alpha Vantage technical indicator data for HT_DCPHASE.

Official Alpha Vantage function: HT_DCPHASE.';
    protected const REQUIRED = array (
  0 => 'symbol',
  1 => 'interval',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Equity symbol.',
  ),
  'interval' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Technical indicator interval.',
    'enum' =>
    array (
      0 => '1min',
      1 => '5min',
      2 => '15min',
      3 => '30min',
      4 => '60min',
      5 => 'daily',
      6 => 'weekly',
      7 => 'monthly',
    ),
  ),
  'time_period' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Number of data points used to calculate the indicator where required.',
  ),
  'series_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Price series to use where required.',
    'enum' =>
    array (
      0 => 'close',
      1 => 'open',
      2 => 'high',
      3 => 'low',
    ),
  ),
  'fastperiod' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Fast period parameter where supported.',
  ),
  'slowperiod' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Slow period parameter where supported.',
  ),
  'matype' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Moving average type parameter where supported.',
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
