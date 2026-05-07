<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates FormField Options.
 *
 * Maps to the official Rootly endpoint post /v1/form_fields/{form_field_id}/options.
 */
class RootlyCreateFormFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_form_field_option';
    protected const DESCRIPTION = 'Creates FormField Options

Official Rootly endpoint: POST /v1/form_fields/{form_field_id}/options

Creates a new form_field_option from provided data';
    protected const PARAMETERS = array (
  'form_field_id' =>
  array (
    'type' => 'string',
    'description' => 'form_field_id parameter.',
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
    protected const PATH = '/v1/form_fields/{form_field_id}/options';
    protected const PATH_PARAMS = array (
  'form_field_id' => 'form_field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
