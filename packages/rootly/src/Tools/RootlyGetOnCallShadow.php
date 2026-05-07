<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an On Call Shadow configuration by ID.
 *
 * Maps to the official Rootly endpoint get /v1/on_call_shadows/{id}.
 */
class RootlyGetOnCallShadow extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_on_call_shadow';
    protected const DESCRIPTION = 'Retrieves an On Call Shadow configuration by ID

Official Rootly endpoint: GET /v1/on_call_shadows/{id}

Retrieves a specific On Call Shadow configuration by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/on_call_shadows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
