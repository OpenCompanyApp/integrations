<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage commodity data for COTTON.
 */
class AlphaVantageCotton extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_cotton';
    protected const FUNCTION = 'COTTON';
    protected const DESCRIPTION = 'Fetch Alpha Vantage commodity data for COTTON.

Official Alpha Vantage function: COTTON.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'interval' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Commodity interval such as daily, weekly, monthly, quarterly, or annual where supported.',
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
