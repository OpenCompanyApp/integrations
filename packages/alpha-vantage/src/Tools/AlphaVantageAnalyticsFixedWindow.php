<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage intelligence data for ANALYTICS_FIXED_WINDOW.
 */
class AlphaVantageAnalyticsFixedWindow extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_analytics_fixed_window';
    protected const FUNCTION = 'ANALYTICS_FIXED_WINDOW';
    protected const DESCRIPTION = 'Fetch Alpha Vantage intelligence data for ANALYTICS_FIXED_WINDOW.

Official Alpha Vantage function: ANALYTICS_FIXED_WINDOW.';
    protected const REQUIRED = array (
  0 => 'SYMBOLS',
  1 => 'RANGE',
);
    protected const PARAMETERS = array (
  'SYMBOLS' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Comma-separated symbols.',
  ),
  'RANGE' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Date range or interval accepted by Alpha Vantage analytics endpoints.',
  ),
  'INTERVAL' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Analytics interval.',
  ),
  'OHLC' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'OHLC field selection.',
  ),
  'CALCULATIONS' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Comma-separated analytics calculations.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
