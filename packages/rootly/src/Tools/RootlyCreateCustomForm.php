<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a custom form.
 *
 * Maps to the official Rootly endpoint post /v1/custom_forms.
 */
class RootlyCreateCustomForm extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_custom_form';
    protected const DESCRIPTION = 'Creates a custom form

Official Rootly endpoint: POST /v1/custom_forms

Creates a new custom form from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/custom_forms';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
