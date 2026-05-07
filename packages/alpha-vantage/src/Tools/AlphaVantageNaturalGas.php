<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage commodity data for NATURAL_GAS.
 */
class AlphaVantageNaturalGas extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_natural_gas';
    protected const FUNCTION = 'NATURAL_GAS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage commodity data for NATURAL_GAS.

Official Alpha Vantage function: NATURAL_GAS.';
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
