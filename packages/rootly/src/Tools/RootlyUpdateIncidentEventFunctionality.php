<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident event.
 *
 * Maps to the official Rootly endpoint put /v1/incident_event_functionalities/{id}.
 */
class RootlyUpdateIncidentEventFunctionality extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_event_functionality';
    protected const DESCRIPTION = 'Update an incident event

Official Rootly endpoint: PUT /v1/incident_event_functionalities/{id}

Update a specific incident event functionality by id';
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
    protected const PATH = '/v1/incident_event_functionalities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
