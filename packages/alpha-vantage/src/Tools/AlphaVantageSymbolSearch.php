<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Search Alpha Vantage symbols by keywords.
 */
class AlphaVantageSymbolSearch extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_symbol_search';
    protected const FUNCTION = 'SYMBOL_SEARCH';
    protected const DESCRIPTION = 'Search Alpha Vantage symbols by keywords.

Official Alpha Vantage function: SYMBOL_SEARCH.';
    protected const REQUIRED = array (
  0 => 'keywords',
);
    protected const PARAMETERS = array (
  'keywords' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Ticker or company-name search keywords.',
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
