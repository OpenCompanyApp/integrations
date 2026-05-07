<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a pulse.
 *
 * Maps to the official Rootly endpoint put /v1/pulses/{id}.
 */
class RootlyUpdatePulse extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_pulse';
    protected const DESCRIPTION = 'Update a pulse

Official Rootly endpoint: PUT /v1/pulses/{id}

Update a specific pulse by id';
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
    protected const PATH = '/v1/pulses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
