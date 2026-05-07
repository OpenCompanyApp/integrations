<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List trip bookings.
 *
 * Maps to the official Brex endpoint get /v1/trips/{trip_id}/bookings.
 */
class BrexTravelListTripBookings extends AbstractBrexTool
{
    protected const NAME = 'brex_travel_list_trip_bookings';
    protected const DESCRIPTION = 'List trip bookings

Official Brex endpoint: GET /v1/trips/{trip_id}/bookings

Lists the bookings within a trip.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'trip_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `trip_id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/trips/{trip_id}/bookings';
    protected const PATH_PARAMS = array (
  'trip_id' => 'trip_id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
