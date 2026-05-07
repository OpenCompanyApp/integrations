<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Delete custom field values.
 *
 * Maps to the official Brex endpoint delete /v1/fields/{field_id}/values.
 */
class BrexFieldsDeleteFieldValues extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_delete_field_values';
    protected const DESCRIPTION = 'Delete custom field values

Official Brex endpoint: DELETE /v1/fields/{field_id}/values

Delete custom field values (up to 1000 values at once) for a specific field';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field_id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/fields/{field_id}/values';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
