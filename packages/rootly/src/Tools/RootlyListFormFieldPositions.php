<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List FormField Position.
 *
 * Maps to the official Rootly endpoint get /v1/form_fields/{form_field_id}/positions.
 */
class RootlyListFormFieldPositions extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_form_field_positions';
    protected const DESCRIPTION = 'List FormField Position

Official Rootly endpoint: GET /v1/form_fields/{form_field_id}/positions

List form field positions';
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
  'filter_form' =>
  array (
    'type' => 'string',
    'description' => 'filter[form] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_fields/{form_field_id}/positions';
    protected const PATH_PARAMS = array (
  'form_field_id' => 'form_field_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[form]' => 'filter_form',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
