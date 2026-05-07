<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * List Permissions by user id.
 *
 * Maps to the official Airbyte endpoint get /permissions.
 */
class AirbyteListPermissions extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_list_permissions';
    protected const DESCRIPTION = 'List Permissions by user id

Official Airbyte endpoint: GET /permissions';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `userId` from the official Airbyte API operation. User Id in permission.',
  ),
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organizationId` from the official Airbyte API operation. This is required if you want to read someone else\'s permissions, and you should have organization admin or a higher role.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/permissions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'userId' => 'user_id',
  'organizationId' => 'organization_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
