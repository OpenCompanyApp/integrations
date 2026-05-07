<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Update a Source and fully overwrite it.
 *
 * Maps to the official Airbyte endpoint put /sources/{sourceId}.
 */
class AirbytePutSource extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_put_source';
    protected const DESCRIPTION = 'Update a Source and fully overwrite it

Official Airbyte endpoint: PUT /sources/{sourceId}';
    protected const PARAMETERS = array (
  'source_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sourceId` from the official Airbyte API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'put';
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
