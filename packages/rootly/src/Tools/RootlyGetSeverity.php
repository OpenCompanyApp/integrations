<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a severity.
 *
 * Maps to the official Rootly endpoint get /v1/severities/{id}.
 */
class RootlyGetSeverity extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_severity';
    protected const DESCRIPTION = 'Retrieves a severity

Official Rootly endpoint: GET /v1/severities/{id}

Retrieves a specific severity by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/severities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
