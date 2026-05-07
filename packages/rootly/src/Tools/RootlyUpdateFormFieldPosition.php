<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a FormFieldPosition.
 *
 * Maps to the official Rootly endpoint put /v1/form_field_positions/{id}.
 */
class RootlyUpdateFormFieldPosition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_form_field_position';
    protected const DESCRIPTION = 'Update a FormFieldPosition

Official Rootly endpoint: PUT /v1/form_field_positions/{id}

Update a specific form_field position by id';
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
    protected const PATH = '/v1/form_field_positions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
