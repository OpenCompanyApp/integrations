<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Create OAuth override credentials for a workspace and source type..
 *
 * Maps to the official Airbyte endpoint put /workspaces/{workspaceId}/oauthCredentials.
 */
class AirbyteCreateOrUpdateWorkspaceOAuthCredentials extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_create_or_update_workspace_oauth_credentials';
    protected const DESCRIPTION = 'Create OAuth override credentials for a workspace and source type.

Official Airbyte endpoint: PUT /workspaces/{workspaceId}/oauthCredentials

Create/update a set of OAuth credentials to override the Airbyte-provided OAuth credentials used for source/destination OAuth. In order to determine what the credential configuration needs to be, please see the connector specification of the relevant source/destination.';
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
    protected const METHOD = 'put';
    protected const PATH = '/workspaces/{workspaceId}/oauthCredentials';
    protected const PATH_PARAMS = array (
  'workspaceId' => 'workspace_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
