<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get a field value.
 *
 * Maps to the official Brex endpoint get /v1/fields/{field_id}/values/{brex_id}.
 */
class BrexFieldsGetFieldValueById extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_get_field_value_by_id';
    protected const DESCRIPTION = 'Get a field value

Official Brex endpoint: GET /v1/fields/{field_id}/values/{brex_id}

Get a field value by field ID and field value ID';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field_id` from the official Brex API operation.',
  ),
  'brex_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `brex_id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/fields/{field_id}/values/{brex_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
  'brex_id' => 'brex_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
