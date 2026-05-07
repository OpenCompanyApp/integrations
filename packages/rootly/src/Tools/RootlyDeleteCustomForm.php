<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a custom form.
 *
 * Maps to the official Rootly endpoint delete /v1/custom_forms/{id}.
 */
class RootlyDeleteCustomForm extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_custom_form';
    protected const DESCRIPTION = 'Delete a custom form

Official Rootly endpoint: DELETE /v1/custom_forms/{id}

Delete a specific custom form by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/custom_forms/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
