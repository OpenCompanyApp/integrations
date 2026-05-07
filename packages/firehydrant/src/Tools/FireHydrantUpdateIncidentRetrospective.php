<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a retrospective on the incident.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/retrospectives/{retrospective_id}.
 */
class FireHydrantUpdateIncidentRetrospective extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_retrospective';
    protected const DESCRIPTION = 'Update a retrospective on the incident

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/retrospectives/{retrospective_id}

Update a retrospective attached to an incident';
    protected const PARAMETERS = array (
  'retrospective_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/{retrospective_id}';
    protected const PATH_PARAMS = array (
  'retrospective_id' => 'retrospective_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
