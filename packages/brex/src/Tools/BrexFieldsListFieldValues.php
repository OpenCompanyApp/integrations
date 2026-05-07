<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List custom field values.
 *
 * Maps to the official Brex endpoint get /v1/fields/{field_id}/values.
 */
class BrexFieldsListFieldValues extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_list_field_values';
    protected const DESCRIPTION = 'List custom field values

Official Brex endpoint: GET /v1/fields/{field_id}/values

List values under the same custom field';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field_id` from the official Brex API operation.',
  ),
  'brex_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `brex_id[]` from the official Brex API operation.',
  ),
  'value_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `value_id[]` from the official Brex API operation.',
  ),
  'remote_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `remote_id[]` from the official Brex API operation.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'value' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `value` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/fields/{field_id}/values';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
  'brex_id[]' => 'brex_id',
  'value_id[]' => 'value_id',
  'remote_id[]' => 'remote_id',
  'cursor' => 'cursor',
  'limit' => 'limit',
  'value' => 'value',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
