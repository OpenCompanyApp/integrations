<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage economic indicator data for REAL_GDP_PER_CAPITA.
 */
class AlphaVantageRealGdpPerCapita extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_real_gdp_per_capita';
    protected const FUNCTION = 'REAL_GDP_PER_CAPITA';
    protected const DESCRIPTION = 'Fetch Alpha Vantage economic indicator data for REAL_GDP_PER_CAPITA.

Official Alpha Vantage function: REAL_GDP_PER_CAPITA.';
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
