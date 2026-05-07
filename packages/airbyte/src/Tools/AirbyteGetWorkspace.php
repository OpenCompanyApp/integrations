<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Get Workspace details.
 *
 * Maps to the official Airbyte endpoint get /workspaces/{workspaceId}.
 */
class AirbyteGetWorkspace extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_workspace';
    protected const DESCRIPTION = 'Get Workspace details

Official Airbyte endpoint: GET /workspaces/{workspaceId}';
    protected const PARAMETERS = array (
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspaceId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'get';
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
