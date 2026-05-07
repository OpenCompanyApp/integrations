<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * Delete a Permission.
 *
 * Maps to the official Airbyte endpoint delete /permissions/{permissionId}.
 */
class AirbyteDeletePermission extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_delete_permission';
    protected const DESCRIPTION = 'Delete a Permission

Official Airbyte endpoint: DELETE /permissions/{permissionId}';
    protected const PARAMETERS = array (
  'permission_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `permissionId` from the official Airbyte API operation.',
  ),
);
    protected const METHOD = 'delete';
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
