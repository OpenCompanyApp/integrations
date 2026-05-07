<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List FormField Options.
 *
 * Maps to the official Rootly endpoint get /v1/form_fields/{form_field_id}/options.
 */
class RootlyListFormFieldOptions extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_form_field_options';
    protected const DESCRIPTION = 'List FormField Options

Official Rootly endpoint: GET /v1/form_fields/{form_field_id}/options

List form_field_options';
    protected const PARAMETERS = array (
  'form_field_id' =>
  array (
    'type' => 'string',
    'description' => 'form_field_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'filter_value' =>
  array (
    'type' => 'string',
    'description' => 'filter[value] parameter.',
  ),
  'filter_color' =>
  array (
    'type' => 'string',
    'description' => 'filter[color] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_fields/{form_field_id}/options';
    protected const PATH_PARAMS = array (
  'form_field_id' => 'form_field_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[value]' => 'filter_value',
  'filter[color]' => 'filter_color',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
