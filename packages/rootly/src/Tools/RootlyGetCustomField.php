<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Retrieves a Custom Field.
 *
 * Maps to the official Rootly endpoint get /v1/custom_fields/{id}.
 */
class RootlyGetCustomField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_custom_field';
    protected const DESCRIPTION = '[DEPRECATED] Retrieves a Custom Field

Official Rootly endpoint: GET /v1/custom_fields/{id}

Retrieves a specific custom_field by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: options',
    'enum' =>
    array (
      0 => 'options',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/custom_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
