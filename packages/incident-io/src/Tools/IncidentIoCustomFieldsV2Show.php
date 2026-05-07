<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Custom Fields V2.
 *
 * Maps to the official incident.io endpoint get /v2/custom_fields/{id}.
 */
class IncidentIoCustomFieldsV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_fields_v2_show';
    protected const DESCRIPTION = 'Show Custom Fields V2

Official incident.io endpoint: GET /v2/custom_fields/{id}

Get a single custom field.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the custom field',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
