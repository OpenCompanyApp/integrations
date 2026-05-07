<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Delete a Custom Field.
 *
 * Maps to the official Rootly endpoint delete /v1/custom_fields/{id}.
 */
class RootlyDeleteCustomField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_custom_field';
    protected const DESCRIPTION = '[DEPRECATED] Delete a Custom Field

Official Rootly endpoint: DELETE /v1/custom_fields/{id}

[DEPRECATED] Use form field endpoints instead. Delete a specific custom field by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/custom_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
