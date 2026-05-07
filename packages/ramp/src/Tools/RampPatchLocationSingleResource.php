<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a location.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/locations/{location_id}.
 */
class RampPatchLocationSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_location_single_resource';
    protected const DESCRIPTION = 'Update a location

Official Ramp endpoint: PATCH /developer/v1/locations/{location_id}';
    protected const PARAMETERS = array (
  'location_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `location_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/locations/{location_id}';
    protected const PATH_PARAMS = array (
  'location_id' => 'location_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
