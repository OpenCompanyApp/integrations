<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for INCOME_STATEMENT.
 */
class AlphaVantageIncomeStatement extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_income_statement';
    protected const FUNCTION = 'INCOME_STATEMENT';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for INCOME_STATEMENT.

Official Alpha Vantage function: INCOME_STATEMENT.';
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
