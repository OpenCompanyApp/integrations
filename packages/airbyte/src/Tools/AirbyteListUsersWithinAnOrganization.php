<?php

namespace OpenCompany\Integrations\Airbyte\Tools;

/**
 * List all users within an organization.
 *
 * Maps to the official Airbyte endpoint get /users.
 */
class AirbyteListUsersWithinAnOrganization extends AbstractAirbyteTool
{
    protected const NAME = 'airbyte_list_users_within_an_organization';
    protected const DESCRIPTION = 'List all users within an organization

Official Airbyte endpoint: GET /users

Organization Admin user can list all users within the same organization. Also provide filtering on a list of user IDs or/and a list of user emails.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `organizationId` from the official Airbyte API operation.',
  ),
  'ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `ids` from the official Airbyte API operation. List of user IDs to filter by',
  ),
  'emails' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `emails` from the official Airbyte API operation. List of user emails to filter by',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'organizationId' => 'organization_id',
  'ids' => 'ids',
  'emails' => 'emails',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
