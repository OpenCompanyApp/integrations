<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for CASH_FLOW.
 */
class AlphaVantageCashFlow extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_cash_flow';
    protected const FUNCTION = 'CASH_FLOW';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for CASH_FLOW.

Official Alpha Vantage function: CASH_FLOW.';
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
