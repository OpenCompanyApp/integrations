<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident form field selections.
 *
 * Maps to the official Rootly endpoint get /v1/incidents/{incident_id}/form_field_selections.
 */
class RootlyListIncidentFormFieldSelections extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_form_field_selections';
    protected const DESCRIPTION = 'List incident form field selections

Official Rootly endpoint: GET /v1/incidents/{incident_id}/form_field_selections

List incident form field selections';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/form_field_selections';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
