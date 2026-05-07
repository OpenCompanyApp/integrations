<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create a custom field.
 *
 * Maps to the official Brex endpoint post /v1/fields.
 */
class BrexFieldsCreateField extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_create_field';
    protected const DESCRIPTION = 'Create a custom field

Official Brex endpoint: POST /v1/fields

Create a custom field';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
