<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Appends a new incident retrospective field to an incident retrospective.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields.
 */
class FireHydrantCreateIncidentRetrospectiveField extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_retrospective_field';
    protected const DESCRIPTION = 'Appends a new incident retrospective field to an incident retrospective

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields

Add a new field to an incident retrospective';
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
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields';
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
