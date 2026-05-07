<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident form field selection.
 *
 * Maps to the official Rootly endpoint post /v1/incidents/{incident_id}/form_field_selections.
 */
class RootlyCreateIncidentFormFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_form_field_selection';
    protected const DESCRIPTION = 'Creates an incident form field selection

Official Rootly endpoint: POST /v1/incidents/{incident_id}/form_field_selections

Creates a new incident form field selection from provided data';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/form_field_selections';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
