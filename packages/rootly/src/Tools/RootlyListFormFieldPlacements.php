<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List Form Field Placements.
 *
 * Maps to the official Rootly endpoint get /v1/form_fields/{form_field_id}/placements.
 */
class RootlyListFormFieldPlacements extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_form_field_placements';
    protected const DESCRIPTION = 'List Form Field Placements

Official Rootly endpoint: GET /v1/form_fields/{form_field_id}/placements

List form_field_placements';
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
  'filter_form_field_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[form_field_id] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_fields/{form_field_id}/placements';
    protected const PATH_PARAMS = array (
  'form_field_id' => 'form_field_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[form_field_id]' => 'filter_form_field_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
