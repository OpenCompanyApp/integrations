<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Custom Fields V1.
 *
 * Maps to the official incident.io endpoint post /v1/custom_fields.
 */
class IncidentIoCustomFieldsV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_fields_v1_create';
    protected const DESCRIPTION = 'Create Custom Fields V1

Official incident.io endpoint: POST /v1/custom_fields

Create a new custom field';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/custom_fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
