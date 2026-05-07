<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage company fundamental data for INSIDER_TRANSACTIONS.
 */
class AlphaVantageInsiderTransactions extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_insider_transactions';
    protected const FUNCTION = 'INSIDER_TRANSACTIONS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage company fundamental data for INSIDER_TRANSACTIONS.

Official Alpha Vantage function: INSIDER_TRANSACTIONS.';
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
