<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident form field selection.
 *
 * Maps to the official Rootly endpoint get /v1/incident_form_field_selections/{id}.
 */
class RootlyGetIncidentFormFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_form_field_selection';
    protected const DESCRIPTION = 'Retrieves an incident form field selection

Official Rootly endpoint: GET /v1/incident_form_field_selections/{id}

Retrieves a specific incident form field selection by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_form_field_selections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
