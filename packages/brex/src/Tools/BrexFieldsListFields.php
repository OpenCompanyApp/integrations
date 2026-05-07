<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List custom fields.
 *
 * Maps to the official Brex endpoint get /v1/fields.
 */
class BrexFieldsListFields extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_list_fields';
    protected const DESCRIPTION = 'List custom fields

Official Brex endpoint: GET /v1/fields

List custom fields under the same account';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `field_id[]` from the official Brex API operation.',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'field_id[]' => 'field_id',
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
