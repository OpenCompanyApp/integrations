<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an override shift.
 *
 * Maps to the official Rootly endpoint put /v1/override_shifts/{id}.
 */
class RootlyUpdateOverrideShift extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_override_shift';
    protected const DESCRIPTION = 'Update an override shift

Official Rootly endpoint: PUT /v1/override_shifts/{id}

Update a specific override shift by id';
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
    protected const PATH = '/v1/override_shifts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
