<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Status.
 *
 * Maps to the official Rootly endpoint get /v1/statuses/{id}.
 */
class RootlyGetStatus extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_status';
    protected const DESCRIPTION = 'Retrieves a Status

Official Rootly endpoint: GET /v1/statuses/{id}

Retrieves a specific Status by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
