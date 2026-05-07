<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a new custom accounting field.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/fields.
 */
class RampPostCustomFieldListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_custom_field_list_resource';
    protected const DESCRIPTION = 'Create a new custom accounting field

Official Ramp endpoint: POST /developer/v1/accounting/fields

If a custom field with the same id already exists on Ramp, then that existing one will be returned instead of creating a new one; If the existing custom field is inactive, it will be reactivated. If you want to update the existing custom field, please use the PATCH developer/v1/accounting/fields/{id} endpoint instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
