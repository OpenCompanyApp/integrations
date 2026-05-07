<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Update Custom Field Options V1.
 *
 * Maps to the official incident.io endpoint put /v1/custom_field_options/{id}.
 */
class IncidentIoCustomFieldOptionsV1Update extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_field_options_v1_update';
    protected const DESCRIPTION = 'Update Custom Field Options V1

Official incident.io endpoint: PUT /v1/custom_field_options/{id}

Update a custom field option';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the custom field option',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/custom_field_options/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
