<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident.
 *
 * Maps to the official Rootly endpoint post /v1/incidents.
 */
class RootlyCreateIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident';
    protected const DESCRIPTION = 'Creates an incident

Official Rootly endpoint: POST /v1/incidents

Creates a new incident from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
