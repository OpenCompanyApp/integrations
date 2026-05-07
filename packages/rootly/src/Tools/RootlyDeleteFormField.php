<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Form Field.
 *
 * Maps to the official Rootly endpoint delete /v1/form_fields/{id}.
 */
class RootlyDeleteFormField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_form_field';
    protected const DESCRIPTION = 'Delete a Form Field

Official Rootly endpoint: DELETE /v1/form_fields/{id}

Delete a specific form_field by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/form_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
