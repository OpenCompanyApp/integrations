<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage calendar/listing data for LISTING_STATUS.
 */
class AlphaVantageListingStatus extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_listing_status';
    protected const FUNCTION = 'LISTING_STATUS';
    protected const DESCRIPTION = 'Fetch Alpha Vantage calendar/listing data for LISTING_STATUS.

Official Alpha Vantage function: LISTING_STATUS.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Listing status date in YYYY-MM-DD format.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Listing state such as active or delisted.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
