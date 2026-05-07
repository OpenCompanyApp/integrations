<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * [DEPRECATED] Update an incident custom field selection.
 *
 * Maps to the official Rootly endpoint put /v1/incident_custom_field_selections/{id}.
 */
class RootlyUpdateIncidentCustomFieldSelection extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_custom_field_selection';
    protected const DESCRIPTION = '[DEPRECATED] Update an incident custom field selection

Official Rootly endpoint: PUT /v1/incident_custom_field_selections/{id}

[DEPRECATED] Use form field endpoints instead. Update a specific incident custom field selection by id';
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
    protected const PATH = '/v1/incident_custom_field_selections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
