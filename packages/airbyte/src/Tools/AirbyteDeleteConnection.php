<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Delete a Connection.
 *
 * Maps to the official Airbyte endpoint delete /connections/{connectionId}.
 */
class AirbyteDeleteConnection extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_delete_connection';
    protected const DESCRIPTION = 'Delete a Connection

Official Airbyte endpoint: DELETE /connections/{connectionId}';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/connections/{connectionId}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
