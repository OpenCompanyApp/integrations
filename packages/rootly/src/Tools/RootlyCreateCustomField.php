<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Creates a Custom Field.
 *
 * Maps to the official Rootly endpoint post /v1/custom_fields.
 */
class RootlyCreateCustomField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_custom_field';
    protected const DESCRIPTION = '[DEPRECATED] Creates a Custom Field

Official Rootly endpoint: POST /v1/custom_fields

[DEPRECATED] Use form field endpoints instead. Creates a new custom field from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/custom_fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
