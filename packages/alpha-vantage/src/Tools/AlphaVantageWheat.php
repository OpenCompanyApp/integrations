<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage commodity data for WHEAT.
 */
class AlphaVantageWheat extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_wheat';
    protected const FUNCTION = 'WHEAT';
    protected const DESCRIPTION = 'Fetch Alpha Vantage commodity data for WHEAT.

Official Alpha Vantage function: WHEAT.';
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
