<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a Form Field.
 *
 * Maps to the official Rootly endpoint post /v1/form_fields.
 */
class RootlyCreateFormField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_form_field';
    protected const DESCRIPTION = 'Creates a Form Field

Official Rootly endpoint: POST /v1/form_fields

Creates a new form_field from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/form_fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
