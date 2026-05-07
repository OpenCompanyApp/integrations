<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Update a permission.
 *
 * Maps to the official Airbyte endpoint patch /permissions/{permissionId}.
 */
class AirbyteUpdatePermission extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_update_permission';
    protected const DESCRIPTION = 'Update a permission

Official Airbyte endpoint: PATCH /permissions/{permissionId}';
    protected const PARAMETERS = array (
  'permission_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `permissionId` from the official Airbyte API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Airbyte API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/permissions/{permissionId}';
    protected const PATH_PARAMS = array (
  'permissionId' => 'permission_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
