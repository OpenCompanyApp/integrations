<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Update a custom field option.
 *
 * Maps to the official Rootly endpoint put /v1/custom_field_options/{id}.
 */
class RootlyUpdateCustomFieldOption extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_custom_field_option';
    protected const DESCRIPTION = '[DEPRECATED] Update a custom field option

Official Rootly endpoint: PUT /v1/custom_field_options/{id}

[DEPRECATED] Use form field endpoints instead. Update a specific custom field option by id';
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
    protected const PATH = '/v1/custom_field_options/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
