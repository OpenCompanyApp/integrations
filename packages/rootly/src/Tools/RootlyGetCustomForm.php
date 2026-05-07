<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a custom form.
 *
 * Maps to the official Rootly endpoint get /v1/custom_forms/{id}.
 */
class RootlyGetCustomForm extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_custom_form';
    protected const DESCRIPTION = 'Retrieves a custom form

Official Rootly endpoint: GET /v1/custom_forms/{id}

Retrieves a specific custom form by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
