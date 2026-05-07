<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage foreign exchange data for FX_WEEKLY.
 */
class AlphaVantageFxWeekly extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_fx_weekly';
    protected const FUNCTION = 'FX_WEEKLY';
    protected const DESCRIPTION = 'Fetch Alpha Vantage foreign exchange data for FX_WEEKLY.

Official Alpha Vantage function: FX_WEEKLY.';
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
  'outputsize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'compact or full output size.',
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
