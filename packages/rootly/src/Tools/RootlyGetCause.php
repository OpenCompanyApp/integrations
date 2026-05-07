<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a cause.
 *
 * Maps to the official Rootly endpoint get /v1/causes/{id}.
 */
class RootlyGetCause extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_cause';
    protected const DESCRIPTION = 'Retrieves a cause

Official Rootly endpoint: GET /v1/causes/{id}

Retrieves a specific cause by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/causes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
