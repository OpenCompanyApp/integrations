<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload new options.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/field-options.
 */
class RampPostCustomFieldOptionListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_custom_field_option_list_resource';
    protected const DESCRIPTION = 'Upload new options

Official Ramp endpoint: POST /developer/v1/accounting/field-options

You can upload up to 500 new field options for a given custom accounting field in an all-or-nothing fashion. If a field option within a batch is malformed or violates a database constraint, the entire batch containing that field option will be disregarded. To have a successful upload, please sanitize the data and ensure the field options that you are trying to upload do not already exist on Ramp. If a field option is already on Ramp but you want to update its attributes, please use the PATCH developer/v1/accounting/field-options/{id} endpoint instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/field-options';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
