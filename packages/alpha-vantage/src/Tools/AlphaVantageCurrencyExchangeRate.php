<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage foreign exchange data for CURRENCY_EXCHANGE_RATE.
 */
class AlphaVantageCurrencyExchangeRate extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_currency_exchange_rate';
    protected const FUNCTION = 'CURRENCY_EXCHANGE_RATE';
    protected const DESCRIPTION = 'Fetch Alpha Vantage foreign exchange data for CURRENCY_EXCHANGE_RATE.

Official Alpha Vantage function: CURRENCY_EXCHANGE_RATE.';
    protected const REQUIRED = array (
  0 => 'from_symbol',
  1 => 'to_symbol',
);
    protected const PARAMETERS = array (
  'from_symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Source currency code.',
  ),
  'to_symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Target currency code.',
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
