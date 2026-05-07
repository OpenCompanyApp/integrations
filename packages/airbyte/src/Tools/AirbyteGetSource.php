<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Get Source details.
 *
 * Maps to the official Airbyte endpoint get /sources/{sourceId}.
 */
class AirbyteGetSource extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_source';
    protected const DESCRIPTION = 'Get Source details

Official Airbyte endpoint: GET /sources/{sourceId}';
    protected const PARAMETERS = array (
  'source_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sourceId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/sources/{sourceId}';
    protected const PATH_PARAMS = array (
  'sourceId' => 'source_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
