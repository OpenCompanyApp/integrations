<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Update Custom Fields V1.
 *
 * Maps to the official incident.io endpoint put /v1/custom_fields/{id}.
 */
class IncidentIoCustomFieldsV1Update extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_fields_v1_update';
    protected const DESCRIPTION = 'Update Custom Fields V1

Official incident.io endpoint: PUT /v1/custom_fields/{id}

Update the details of a custom field';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the custom field',
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
    protected const PATH = '/v1/custom_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
