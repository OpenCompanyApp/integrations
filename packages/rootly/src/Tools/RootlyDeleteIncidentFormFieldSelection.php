<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident form field selection.
 *
 * Maps to the official Rootly endpoint delete /v1/incident_form_field_selections/{id}.
 */
class RootlyDeleteIncidentFormFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_form_field_selection';
    protected const DESCRIPTION = 'Delete an incident form field selection

Official Rootly endpoint: DELETE /v1/incident_form_field_selections/{id}

Delete a specific incident form field selection by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
