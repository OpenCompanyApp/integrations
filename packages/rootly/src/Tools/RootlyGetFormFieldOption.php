<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves FormField Options.
 *
 * Maps to the official Rootly endpoint get /v1/form_field_options/{id}.
 */
class RootlyGetFormFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_form_field_option';
    protected const DESCRIPTION = 'Retrieves FormField Options

Official Rootly endpoint: GET /v1/form_field_options/{id}

Retrieves a specific form_field_option by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_field_options/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
