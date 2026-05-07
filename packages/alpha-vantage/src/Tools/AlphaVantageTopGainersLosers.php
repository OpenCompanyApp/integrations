<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage intelligence data for TOP_GAINERS_LOSERS.
 */
class AlphaVantageTopGainersLosers extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_top_gainers_losers';
    protected const FUNCTION = 'TOP_GAINERS_LOSERS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage intelligence data for TOP_GAINERS_LOSERS.

Official Alpha Vantage function: TOP_GAINERS_LOSERS.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
