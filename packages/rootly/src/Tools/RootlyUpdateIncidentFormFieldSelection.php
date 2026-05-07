<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident form field selection.
 *
 * Maps to the official Rootly endpoint put /v1/incident_form_field_selections/{id}.
 */
class RootlyUpdateIncidentFormFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_form_field_selection';
    protected const DESCRIPTION = 'Update an incident form field selection

Official Rootly endpoint: PUT /v1/incident_form_field_selections/{id}

Update a specific incident form field selection by id';
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
    protected const PATH = '/v1/incident_form_field_selections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
