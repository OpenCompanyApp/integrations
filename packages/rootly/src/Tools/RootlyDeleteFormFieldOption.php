<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete FormField Options.
 *
 * Maps to the official Rootly endpoint delete /v1/form_field_options/{id}.
 */
class RootlyDeleteFormFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_form_field_option';
    protected const DESCRIPTION = 'Delete FormField Options

Official Rootly endpoint: DELETE /v1/form_field_options/{id}

Delete a specific form_field_option by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
