<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Delete a Workspace.
 *
 * Maps to the official Airbyte endpoint delete /workspaces/{workspaceId}.
 */
class AirbyteDeleteWorkspace extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_delete_workspace';
    protected const DESCRIPTION = 'Delete a Workspace

Official Airbyte endpoint: DELETE /workspaces/{workspaceId}';
    protected const PARAMETERS = array (
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspaceId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/workspaces/{workspaceId}';
    protected const PATH_PARAMS = array (
  'workspaceId' => 'workspace_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
