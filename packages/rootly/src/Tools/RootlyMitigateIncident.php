<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Mitigate an incident.
 *
 * Maps to the official Rootly endpoint put /v1/incidents/{id}/mitigate.
 */
class RootlyMitigateIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_mitigate_incident';
    protected const DESCRIPTION = 'Mitigate an incident

Official Rootly endpoint: PUT /v1/incidents/{id}/mitigate

Mitigate a specific incident by id';
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
    protected const PATH = '/v1/incidents/{id}/mitigate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
