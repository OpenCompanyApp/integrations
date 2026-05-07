<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Retrieves a custom field option.
 *
 * Maps to the official Rootly endpoint get /v1/custom_field_options/{id}.
 */
class RootlyGetCustomFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_custom_field_option';
    protected const DESCRIPTION = '[DEPRECATED] Retrieves a custom field option

Official Rootly endpoint: GET /v1/custom_field_options/{id}

[DEPRECATED] Use form field endpoints instead. Retrieves a specific custom field option by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
