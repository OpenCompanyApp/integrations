<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Custom Fields V2.
 *
 * Maps to the official incident.io endpoint post /v2/custom_fields.
 */
class IncidentIoCustomFieldsV2Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_fields_v2_create';
    protected const DESCRIPTION = 'Create Custom Fields V2

Official incident.io endpoint: POST /v2/custom_fields

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
    protected const PATH = '/v2/custom_fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
