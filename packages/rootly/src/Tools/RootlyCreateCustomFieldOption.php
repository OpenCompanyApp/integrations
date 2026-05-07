<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Creates a custom field option.
 *
 * Maps to the official Rootly endpoint post /v1/custom_fields/{custom_field_id}/options.
 */
class RootlyCreateCustomFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_custom_field_option';
    protected const DESCRIPTION = '[DEPRECATED] Creates a custom field option

Official Rootly endpoint: POST /v1/custom_fields/{custom_field_id}/options

[DEPRECATED] Use form field endpoints instead. Creates a new custom field option from provided data';
    protected const PARAMETERS = array (
  'custom_field_id' =>
  array (
    'type' => 'string',
    'description' => 'custom_field_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/custom_fields/{custom_field_id}/options';
    protected const PATH_PARAMS = array (
  'custom_field_id' => 'custom_field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
