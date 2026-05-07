<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage commodity data for GOLD_SILVER_SPOT.
 */
class AlphaVantageGoldSilverSpot extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_gold_silver_spot';
    protected const FUNCTION = 'GOLD_SILVER_SPOT';
    protected const DESCRIPTION = 'Fetch Alpha Vantage commodity data for GOLD_SILVER_SPOT.

Official Alpha Vantage function: GOLD_SILVER_SPOT.';
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
