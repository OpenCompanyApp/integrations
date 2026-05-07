<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Update a workspace.
 *
 * Maps to the official Airbyte endpoint patch /workspaces/{workspaceId}.
 */
class AirbyteUpdateWorkspace extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_update_workspace';
    protected const DESCRIPTION = 'Update a workspace

Official Airbyte endpoint: PATCH /workspaces/{workspaceId}';
    protected const PARAMETERS = array (
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspaceId` from the official Airbyte API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/workspaces/{workspaceId}';
    protected const PATH_PARAMS = array (
  'workspaceId' => 'workspace_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
