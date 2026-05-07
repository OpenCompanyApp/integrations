<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage index data for INDEX_DATA.
 */
class AlphaVantageIndexData extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_index_data';
    protected const FUNCTION = 'INDEX_DATA';
    protected const DESCRIPTION = 'Fetch Alpha Vantage index data for INDEX_DATA.

Official Alpha Vantage function: INDEX_DATA.';
    protected const REQUIRED = array (
  0 => 'symbol',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Index symbol from the index catalog.',
  ),
  'interval' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Index data interval where supported.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
