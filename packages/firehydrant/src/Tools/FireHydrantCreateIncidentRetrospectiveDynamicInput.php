<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Add a new dynamic input field to a retrospective's dynamic input group field.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}/inputs.
 */
class FireHydrantCreateIncidentRetrospectiveDynamicInput extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_retrospective_dynamic_input';
    protected const DESCRIPTION = 'Add a new dynamic input field to a retrospective\'s dynamic input group field

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}/inputs

Add a new dynamic input field to a dynamic input group';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}/inputs';
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
