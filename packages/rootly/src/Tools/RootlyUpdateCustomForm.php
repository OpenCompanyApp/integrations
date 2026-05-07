<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a custom form.
 *
 * Maps to the official Rootly endpoint put /v1/custom_forms/{id}.
 */
class RootlyUpdateCustomForm extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_custom_form';
    protected const DESCRIPTION = 'Update a custom form

Official Rootly endpoint: PUT /v1/custom_forms/{id}

Update a specific custom form by id';
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
    protected const PATH = '/v1/custom_forms/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
