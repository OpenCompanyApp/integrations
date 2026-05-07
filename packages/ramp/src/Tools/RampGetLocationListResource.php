<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List locations.
 *
 * Maps to the official Ramp endpoint get /developer/v1/locations.
 */
class RampGetLocationListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_location_list_resource';
    protected const DESCRIPTION = 'List locations

Official Ramp endpoint: GET /developer/v1/locations';
    protected const PARAMETERS = array (
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'entity_id' => 'entity_id',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
