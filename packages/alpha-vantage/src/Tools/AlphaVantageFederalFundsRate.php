<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage economic indicator data for FEDERAL_FUNDS_RATE.
 */
class AlphaVantageFederalFundsRate extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_federal_funds_rate';
    protected const FUNCTION = 'FEDERAL_FUNDS_RATE';
    protected const DESCRIPTION = 'Fetch Alpha Vantage economic indicator data for FEDERAL_FUNDS_RATE.

Official Alpha Vantage function: FEDERAL_FUNDS_RATE.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'interval' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Economic data interval such as monthly, quarterly, semiannual, or annual where supported.',
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
