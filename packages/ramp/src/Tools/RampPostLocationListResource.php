<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a location.
 *
 * Maps to the official Ramp endpoint post /developer/v1/locations.
 */
class RampPostLocationListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_location_list_resource';
    protected const DESCRIPTION = 'Create a location

Official Ramp endpoint: POST /developer/v1/locations';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
