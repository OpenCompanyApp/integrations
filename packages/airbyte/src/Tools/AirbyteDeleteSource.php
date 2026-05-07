<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Delete a Source.
 *
 * Maps to the official Airbyte endpoint delete /sources/{sourceId}.
 */
class AirbyteDeleteSource extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_delete_source';
    protected const DESCRIPTION = 'Delete a Source

Official Airbyte endpoint: DELETE /sources/{sourceId}';
    protected const PARAMETERS = array (
  'source_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sourceId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'delete';
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
