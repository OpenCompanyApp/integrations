<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a custom form collection response by ID.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-form/collections/responses/{custom_form_collection_response_id}.
 */
class RampGetCustomFormCollectionResponseResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_custom_form_collection_response_resource';
    protected const DESCRIPTION = 'Fetch a custom form collection response by ID

Official Ramp endpoint: GET /developer/v1/custom-form/collections/responses/{custom_form_collection_response_id}';
    protected const PARAMETERS = array (
  'custom_form_collection_response_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `custom_form_collection_response_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-form/collections/responses/{custom_form_collection_response_id}';
    protected const PATH_PARAMS = array (
  'custom_form_collection_response_id' => 'custom_form_collection_response_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
