<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for SPLITS.
 */
class AlphaVantageSplits extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_splits';
    protected const FUNCTION = 'SPLITS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for SPLITS.

Official Alpha Vantage function: SPLITS.';
    protected const REQUIRED = array (
  0 => 'symbol',
);
    protected const PARAMETERS = array (
  'symbol' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Equity or ETF symbol.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
