<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create custom field values.
 *
 * Maps to the official Brex endpoint post /v1/fields/{field_id}/values.
 */
class BrexFieldsCreateFieldValues extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_create_field_values';
    protected const DESCRIPTION = 'Create custom field values

Official Brex endpoint: POST /v1/fields/{field_id}/values

Create custom field values (up to 1000 values at once) for a specific field';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field_id` from the official Brex API operation.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/fields/{field_id}/values';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
