<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for BALANCE_SHEET.
 */
class AlphaVantageBalanceSheet extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_balance_sheet';
    protected const FUNCTION = 'BALANCE_SHEET';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for BALANCE_SHEET.

Official Alpha Vantage function: BALANCE_SHEET.';
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
