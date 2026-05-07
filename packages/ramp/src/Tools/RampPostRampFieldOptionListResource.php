<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload new options for a Ramp-only field.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/ramp-field-options.
 */
class RampPostRampFieldOptionListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_ramp_field_option_list_resource';
    protected const DESCRIPTION = 'Upload new options for a Ramp-only field

Official Ramp endpoint: POST /developer/v1/accounting/ramp-field-options';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/ramp-field-options';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
