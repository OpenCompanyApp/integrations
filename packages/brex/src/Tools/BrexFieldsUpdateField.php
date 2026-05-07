<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Update a custom field.
 *
 * Maps to the official Brex endpoint put /v1/fields/{id}.
 */
class BrexFieldsUpdateField extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_update_field';
    protected const DESCRIPTION = 'Update a custom field

Official Brex endpoint: PUT /v1/fields/{id}

Update a field by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
