<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a FormFieldPosition.
 *
 * Maps to the official Rootly endpoint delete /v1/form_field_positions/{id}.
 */
class RootlyDeleteFormFieldPosition extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_form_field_position';
    protected const DESCRIPTION = 'Delete a FormFieldPosition

Official Rootly endpoint: DELETE /v1/form_field_positions/{id}

Delete a specific form_field position by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
