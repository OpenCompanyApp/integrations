<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage index data for INDEX_CATALOG.
 */
class AlphaVantageIndexCatalog extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_index_catalog';
    protected const FUNCTION = 'INDEX_CATALOG';
    protected const DESCRIPTION = 'Fetch Alpha Vantage index data for INDEX_CATALOG.

Official Alpha Vantage function: INDEX_CATALOG.';
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
