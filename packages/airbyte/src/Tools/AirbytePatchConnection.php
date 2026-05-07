<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Update Connection details.
 *
 * Maps to the official Airbyte endpoint patch /connections/{connectionId}.
 */
class AirbytePatchConnection extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_patch_connection';
    protected const DESCRIPTION = 'Update Connection details

Official Airbyte endpoint: PATCH /connections/{connectionId}';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Airbyte API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/connections/{connectionId}';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
