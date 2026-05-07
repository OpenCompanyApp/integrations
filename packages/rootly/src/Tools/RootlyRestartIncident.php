<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Restart an incident.
 *
 * Maps to the official Rootly endpoint put /v1/incidents/{id}/restart.
 */
class RootlyRestartIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_restart_incident';
    protected const DESCRIPTION = 'Restart an incident

Official Rootly endpoint: PUT /v1/incidents/{id}/restart

Restart a specific incident by id';
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
    protected const PATH = '/v1/incidents/{id}/restart';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
