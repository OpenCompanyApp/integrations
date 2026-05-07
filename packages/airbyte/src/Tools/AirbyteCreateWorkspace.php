<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Create a workspace.
 *
 * Maps to the official Airbyte endpoint post /workspaces.
 */
class AirbyteCreateWorkspace extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_create_workspace';
    protected const DESCRIPTION = 'Create a workspace

Official Airbyte endpoint: POST /workspaces';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/workspaces';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
