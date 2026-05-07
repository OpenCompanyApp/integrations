<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident retrospective step.
 *
 * Maps to the official Rootly endpoint get /v1/incident_retrospective_steps/{id}.
 */
class RootlyGetIncidentRetrospectiveStep extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_retrospective_step';
    protected const DESCRIPTION = 'Retrieves an incident retrospective step

Official Rootly endpoint: GET /v1/incident_retrospective_steps/{id}

Retrieves a specific incident retrospective step by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_retrospective_steps/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
