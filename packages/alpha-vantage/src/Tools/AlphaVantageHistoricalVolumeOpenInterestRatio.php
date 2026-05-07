<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage US options data for HISTORICAL_VOLUME_OPEN_INTEREST_RATIO.
 */
class AlphaVantageHistoricalVolumeOpenInterestRatio extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_historical_volume_open_interest_ratio';
    protected const FUNCTION = 'HISTORICAL_VOLUME_OPEN_INTEREST_RATIO';
    protected const DESCRIPTION = 'Fetch Alpha Vantage US options data for HISTORICAL_VOLUME_OPEN_INTEREST_RATIO.

Official Alpha Vantage function: HISTORICAL_VOLUME_OPEN_INTEREST_RATIO.';
    protected const REQUIRED = array (
  0 => 'symbol',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Underlying equity symbol.',
  ),
  'date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional date in YYYY-MM-DD format where supported.',
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
