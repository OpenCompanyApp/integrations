<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Retrieves an incident custom field selection.
 *
 * Maps to the official Rootly endpoint get /v1/incident_custom_field_selections/{id}.
 */
class RootlyGetIncidentCustomFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_custom_field_selection';
    protected const DESCRIPTION = '[DEPRECATED] Retrieves an incident custom field selection

Official Rootly endpoint: GET /v1/incident_custom_field_selections/{id}

[DEPRECATED] Use form field endpoints instead. Retrieves a specific incident custom field selection by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_custom_field_selections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
