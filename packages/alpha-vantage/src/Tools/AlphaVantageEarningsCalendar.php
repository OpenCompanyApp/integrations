<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

/**
 * Fetch Alpha Vantage calendar/listing data for EARNINGS_CALENDAR.
 */
class AlphaVantageEarningsCalendar extends AbstractAlphaVantageTool
{
    protected const NAME = 'alpha_vantage_earnings_calendar';
    protected const FUNCTION = 'EARNINGS_CALENDAR';
    protected const DESCRIPTION = 'Fetch Alpha Vantage calendar/listing data for EARNINGS_CALENDAR.

Official Alpha Vantage function: EARNINGS_CALENDAR.';
    protected const REQUIRED = array (
);
    protected const PARAMETERS = array (
  'horizon' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Calendar horizon such as 3month, 6month, or 12month.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional official Alpha Vantage query parameters for this function.',
  ),
);
}
