<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get available values for a custom field.
 *
 * Maps to the official FireHydrant endpoint get /v1/custom_fields/definitions/{field_id}/select_options.
 */
class FireHydrantListCustomFieldSelectOptions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_custom_field_select_options';
    protected const DESCRIPTION = 'Get available values for a custom field

Official FireHydrant endpoint: GET /v1/custom_fields/definitions/{field_id}/select_options

Get the permissible values for the a currently active custom select or multi-select field.';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Text string of a query for filtering values.',
  ),
  'all_versions' =>
  array (
    'type' => 'boolean',
    'description' => 'If true, return all versions of the custom field definition.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/custom_fields/definitions/{field_id}/select_options';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'all_versions' => 'all_versions',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
