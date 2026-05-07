<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a pulse.
 *
 * Maps to the official Rootly endpoint post /v1/pulses.
 */
class RootlyCreatePulse extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_pulse';
    protected const DESCRIPTION = 'Creates a pulse

Official Rootly endpoint: POST /v1/pulses

Creates a new pulse from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/pulses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
