<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get data for a form field on select.
 *
 * Maps to the official FireHydrant endpoint get /v1/form_configurations/{slug}/append_data_on_select/{field_id}/{selected_value}.
 */
class FireHydrantAppendFormDataOnSelectedValueGet extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_append_form_data_on_selected_value_get';
    protected const DESCRIPTION = 'Get data for a form field on select

Official FireHydrant endpoint: GET /v1/form_configurations/{slug}/append_data_on_select/{field_id}/{selected_value}

Get data for a form field on select that should be appended to a form by using a template';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'description' => 'slug parameter.',
    'required' => true,
  ),
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
  'selected_value' =>
  array (
    'type' => 'string',
    'description' => 'selected_value parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_configurations/{slug}/append_data_on_select/{field_id}/{selected_value}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
  'field_id' => 'field_id',
  'selected_value' => 'selected_value',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
