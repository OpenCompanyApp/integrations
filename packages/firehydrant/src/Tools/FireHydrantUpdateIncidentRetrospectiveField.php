<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update the value on a retrospective field.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}.
 */
class FireHydrantUpdateIncidentRetrospectiveField extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_retrospective_field';
    protected const DESCRIPTION = 'Update the value on a retrospective field

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}

Update retrospective field value';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
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
    protected const BODY_REQUIRED = true;
}
