<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage calendar/listing data for IPO_CALENDAR.
 */
class AlphaVantageIpoCalendar extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_ipo_calendar';
    protected const FUNCTION = 'IPO_CALENDAR';
    protected const DESCRIPTION = 'Fetch Alpha Vantage calendar/listing data for IPO_CALENDAR.

Official Alpha Vantage function: IPO_CALENDAR.';
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
