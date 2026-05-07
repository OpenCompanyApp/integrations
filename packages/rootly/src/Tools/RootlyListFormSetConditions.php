<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List Form Set Conditions.
 *
 * Maps to the official Rootly endpoint get /v1/form_sets/{form_set_id}/conditions.
 */
class RootlyListFormSetConditions extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_form_set_conditions';
    protected const DESCRIPTION = 'List Form Set Conditions

Official Rootly endpoint: GET /v1/form_sets/{form_set_id}/conditions

List form_set_conditions';
    protected const PARAMETERS = array (
  'form_set_id' =>
  array (
    'type' => 'string',
    'description' => 'form_set_id parameter.',
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
    protected const PATH = '/v1/form_sets/{form_set_id}/conditions';
    protected const PATH_PARAMS = array (
  'form_set_id' => 'form_set_id',
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
