<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a FormFieldPosition.
 *
 * Maps to the official Rootly endpoint get /v1/form_field_positions/{id}.
 */
class RootlyGetFormFieldPosition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_form_field_position';
    protected const DESCRIPTION = 'Retrieves a FormFieldPosition

Official Rootly endpoint: GET /v1/form_field_positions/{id}

Retrieves a specific form field_position by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_field_positions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
