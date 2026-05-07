<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a pulse.
 *
 * Maps to the official Rootly endpoint get /v1/pulses/{id}.
 */
class RootlyGetPulse extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_pulse';
    protected const DESCRIPTION = 'Retrieves a pulse

Official Rootly endpoint: GET /v1/pulses/{id}

Retrieves a specific pulse by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/pulses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
