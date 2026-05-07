<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage crypto currency data for DIGITAL_CURRENCY_MONTHLY.
 */
class AlphaVantageDigitalCurrencyMonthly extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_digital_currency_monthly';
    protected const FUNCTION = 'DIGITAL_CURRENCY_MONTHLY';
    protected const DESCRIPTION = 'Fetch Alpha Vantage crypto currency data for DIGITAL_CURRENCY_MONTHLY.

Official Alpha Vantage function: DIGITAL_CURRENCY_MONTHLY.';
    protected const REQUIRED = array (
  0 => 'symbol',
  1 => 'market',
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
