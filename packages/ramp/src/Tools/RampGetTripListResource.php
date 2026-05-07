<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List all trips for the business.
 *
 * Maps to the official Ramp endpoint get /developer/v1/trips.
 */
class RampGetTripListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_trip_list_resource';
    protected const DESCRIPTION = 'List all trips for the business

Official Ramp endpoint: GET /developer/v1/trips';
    protected const PARAMETERS = array (
  'user_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `user_ids` from the official Ramp API operation.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'cancelled',
      1 => 'completed',
      2 => 'ongoing',
      3 => 'upcoming',
    ),
  ),
  'from_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_date` from the official Ramp API operation.',
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_date` from the official Ramp API operation.',
  ),
  'min_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `min_amount` from the official Ramp API operation.',
  ),
  'max_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `max_amount` from the official Ramp API operation.',
  ),
  'trip_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `trip_name` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/trips';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'user_ids' => 'user_ids',
  'status' => 'status',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'min_amount' => 'min_amount',
  'max_amount' => 'max_amount',
  'trip_name' => 'trip_name',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
