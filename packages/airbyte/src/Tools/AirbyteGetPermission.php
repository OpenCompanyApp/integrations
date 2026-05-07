<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Get Permission details.
 *
 * Maps to the official Airbyte endpoint get /permissions/{permissionId}.
 */
class AirbyteGetPermission extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_get_permission';
    protected const DESCRIPTION = 'Get Permission details

Official Airbyte endpoint: GET /permissions/{permissionId}';
    protected const PARAMETERS = array (
  'permission_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `permissionId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/permissions/{permissionId}';
    protected const PATH_PARAMS = array (
  'permissionId' => 'permission_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
