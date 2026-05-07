<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage economic indicator data for TREASURY_YIELD.
 */
class AlphaVantageTreasuryYield extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_treasury_yield';
    protected const FUNCTION = 'TREASURY_YIELD';
    protected const DESCRIPTION = 'Fetch Alpha Vantage economic indicator data for TREASURY_YIELD.

Official Alpha Vantage function: TREASURY_YIELD.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'interval' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Economic data interval such as monthly, quarterly, semiannual, or annual where supported.',
  ),
  'maturity' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Treasury maturity such as 3month, 2year, 10year, or 30year.',
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
