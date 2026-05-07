<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident type.
 *
 * Maps to the official Rootly endpoint post /v1/incident_types.
 */
class RootlyCreateIncidentType extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_type';
    protected const DESCRIPTION = 'Creates an incident type

Official Rootly endpoint: POST /v1/incident_types

Creates a new incident_type from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
