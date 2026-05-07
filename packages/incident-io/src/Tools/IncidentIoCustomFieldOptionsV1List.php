<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Custom Field Options V1.
 *
 * Maps to the official incident.io endpoint get /v1/custom_field_options.
 */
class IncidentIoCustomFieldOptionsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_custom_field_options_v1_list';
    protected const DESCRIPTION = 'List Custom Field Options V1

Official incident.io endpoint: GET /v1/custom_field_options

Show custom field options for a custom field';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'A custom field option\'s ID. This endpoint will return a list of custom field options created after this option.',
  ),
  'custom_field_id' =>
  array (
    'type' => 'string',
    'description' => 'The custom field to list options for.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/custom_field_options';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'custom_field_id' => 'custom_field_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
