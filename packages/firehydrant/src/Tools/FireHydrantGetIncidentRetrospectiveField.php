<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a retrospective field.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}.
 */
class FireHydrantGetIncidentRetrospectiveField extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident_retrospective_field';
    protected const DESCRIPTION = 'Get a retrospective field

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}

Retrieve a field on an incident retrospective';
    protected const PARAMETERS = array (
  'retrospective_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_id parameter.',
    'required' => true,
  ),
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}';
    protected const PATH_PARAMS = array (
  'retrospective_id' => 'retrospective_id',
  'field_id' => 'field_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
