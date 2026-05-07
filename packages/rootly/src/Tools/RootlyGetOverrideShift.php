<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an override shift.
 *
 * Maps to the official Rootly endpoint get /v1/override_shifts/{id}.
 */
class RootlyGetOverrideShift extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_override_shift';
    protected const DESCRIPTION = 'Retrieves an override shift

Official Rootly endpoint: GET /v1/override_shifts/{id}

Retrieves a specific override shift by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/override_shifts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
