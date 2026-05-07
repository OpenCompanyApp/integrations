<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get booking.
 *
 * Maps to the official Brex endpoint get /v1/trips/{trip_id}/bookings/{booking_id}.
 */
class BrexTravelGetBooking extends AbstractBrexTool
{
    protected const NAME = 'brex_travel_get_booking';
    protected const DESCRIPTION = 'Get booking

Official Brex endpoint: GET /v1/trips/{trip_id}/bookings/{booking_id}

Retrieves a booking by trip and booking ID.';
    protected const PARAMETERS = array (
  'trip_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `trip_id` from the official Brex API operation.',
  ),
  'booking_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `booking_id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/trips/{trip_id}/bookings/{booking_id}';
    protected const PATH_PARAMS = array (
  'trip_id' => 'trip_id',
  'booking_id' => 'booking_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
