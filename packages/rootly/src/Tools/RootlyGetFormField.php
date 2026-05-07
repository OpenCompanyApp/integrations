<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Form Field.
 *
 * Maps to the official Rootly endpoint get /v1/form_fields/{id}.
 */
class RootlyGetFormField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_form_field';
    protected const DESCRIPTION = 'Retrieves a Form Field

Official Rootly endpoint: GET /v1/form_fields/{id}

Retrieves a specific form_field by id';
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
    'description' => 'comma separated if needed. eg: options,positions',
    'enum' =>
    array (
      0 => 'options',
      1 => 'positions',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_fields/{id}';
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
