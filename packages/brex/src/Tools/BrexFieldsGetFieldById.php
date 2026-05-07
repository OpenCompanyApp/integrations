<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get custom field.
 *
 * Maps to the official Brex endpoint get /v1/fields/{id}.
 */
class BrexFieldsGetFieldById extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_get_field_by_id';
    protected const DESCRIPTION = 'Get custom field

Official Brex endpoint: GET /v1/fields/{id}

Get a custom field by Brex ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
