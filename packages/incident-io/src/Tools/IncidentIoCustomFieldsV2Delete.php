<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Custom Fields V2.
 *
 * Maps to the official incident.io endpoint delete /v2/custom_fields/{id}.
 */
class IncidentIoCustomFieldsV2Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_fields_v2_delete';
    protected const DESCRIPTION = 'Delete Custom Fields V2

Official incident.io endpoint: DELETE /v2/custom_fields/{id}

Delete a custom field';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the custom field',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/custom_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
