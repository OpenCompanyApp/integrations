<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage crypto currency data for CRYPTO_INTRADAY.
 */
class AlphaVantageCryptoIntraday extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_crypto_intraday';
    protected const FUNCTION = 'CRYPTO_INTRADAY';
    protected const DESCRIPTION = 'Fetch Alpha Vantage crypto currency data for CRYPTO_INTRADAY.

Official Alpha Vantage function: CRYPTO_INTRADAY.';
    protected const REQUIRED = array (
  0 => 'symbol',
  1 => 'market',
  2 => 'interval',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Digital currency symbol such as BTC.',
  ),
  'market' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Market currency such as USD.',
  ),
  'interval' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Crypto intraday interval.',
    'enum' =>
    array (
      0 => '1min',
      1 => '5min',
      2 => '15min',
      3 => '30min',
      4 => '60min',
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
