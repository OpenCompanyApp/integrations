<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Update a Custom Field.
 *
 * Maps to the official Rootly endpoint put /v1/custom_fields/{id}.
 */
class RootlyUpdateCustomField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_custom_field';
    protected const DESCRIPTION = '[DEPRECATED] Update a Custom Field

Official Rootly endpoint: PUT /v1/custom_fields/{id}

[DEPRECATED] Use form field endpoints instead. Update a specific custom field by id';
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
    protected const PATH = '/v1/custom_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
