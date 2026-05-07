<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Custom Field Options V1.
 *
 * Maps to the official incident.io endpoint delete /v1/custom_field_options/{id}.
 */
class IncidentIoCustomFieldOptionsV1Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_field_options_v1_delete';
    protected const DESCRIPTION = 'Delete Custom Field Options V1

Official incident.io endpoint: DELETE /v1/custom_field_options/{id}

Delete a custom field option';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the custom field option',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/custom_field_options/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
