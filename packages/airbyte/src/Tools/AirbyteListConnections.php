<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * List connections.
 *
 * Maps to the official Airbyte endpoint get /connections.
 */
class AirbyteListConnections extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_list_connections';
    protected const DESCRIPTION = 'List connections

Official Airbyte endpoint: GET /connections';
    protected const PARAMETERS = array (
  'workspace_ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `workspaceIds` from the official Airbyte API operation. The UUIDs of the workspaces you wish to list connections for. Empty list will retrieve all allowed workspaces.',
  ),
  'include_deleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `includeDeleted` from the official Airbyte API operation. Include deleted connections in the returned results.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Airbyte API operation. Set the limit on the number of Connections returned. The default is 20.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `offset` from the official Airbyte API operation. Set the offset to start at when returning Connections. The default is 0',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'workspaceIds' => 'workspace_ids',
  'includeDeleted' => 'include_deleted',
  'limit' => 'limit',
  'offset' => 'offset',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
