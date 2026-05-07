<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage US options data for REALTIME_PUT_CALL_RATIO.
 */
class AlphaVantageRealtimePutCallRatio extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_realtime_put_call_ratio';
    protected const FUNCTION = 'REALTIME_PUT_CALL_RATIO';
    protected const DESCRIPTION = 'Fetch Alpha Vantage US options data for REALTIME_PUT_CALL_RATIO.

Official Alpha Vantage function: REALTIME_PUT_CALL_RATIO.';
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
