<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Removes a dynamic input from a retrospective's dynamic input group field.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}/inputs.
 */
class FireHydrantDeleteIncidentRetrospectiveDynamicInput extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_retrospective_dynamic_input';
    protected const DESCRIPTION = 'Removes a dynamic input from a retrospective\'s dynamic input group field

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}/inputs

Delete a dynamic input on a dynamic input group';
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
  'dynamic_input_field_id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of the dynamic input field to delete.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives/{retrospective_id}/fields/{field_id}/inputs';
    protected const PATH_PARAMS = array (
  'retrospective_id' => 'retrospective_id',
  'field_id' => 'field_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'dynamic_input_field_id' => 'dynamic_input_field_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
