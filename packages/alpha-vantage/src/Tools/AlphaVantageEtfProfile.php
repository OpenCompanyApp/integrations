<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for ETF_PROFILE.
 */
class AlphaVantageEtfProfile extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_etf_profile';
    protected const FUNCTION = 'ETF_PROFILE';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for ETF_PROFILE.

Official Alpha Vantage function: ETF_PROFILE.';
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
