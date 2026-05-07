<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update FormField Options.
 *
 * Maps to the official Rootly endpoint put /v1/form_field_options/{id}.
 */
class RootlyUpdateFormFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_form_field_option';
    protected const DESCRIPTION = 'Update FormField Options

Official Rootly endpoint: PUT /v1/form_field_options/{id}

Update a specific form_field_option by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/form_field_options/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
