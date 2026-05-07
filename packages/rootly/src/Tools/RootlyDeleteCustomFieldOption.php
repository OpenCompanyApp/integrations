<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Delete a custom field option.
 *
 * Maps to the official Rootly endpoint delete /v1/custom_field_options/{id}.
 */
class RootlyDeleteCustomFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_custom_field_option';
    protected const DESCRIPTION = '[DEPRECATED] Delete a custom field option

Official Rootly endpoint: DELETE /v1/custom_field_options/{id}

[DEPRECATED] Use form field endpoints instead. Delete a specific Custom Field Option by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/custom_field_options/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
