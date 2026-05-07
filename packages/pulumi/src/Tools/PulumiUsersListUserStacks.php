<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListUserStacks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/stacks.
 */
class PulumiUsersListUserStacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_list_user_stacks';
    protected const DESCRIPTION = 'ListUserStacks

Official Pulumi Cloud endpoint: GET /api/user/stacks

Lists all stacks accessible to the authenticated user. Results can be filtered by organization, project, and stack tags (tagName/tagValue). Supports pagination via continuationToken and maxResults parameters. Returns stack summary information including name, project, last update status, and resource count.';
    protected const PARAMETERS = array (
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Token from a previous response to fetch the next page of results',
  ),
  'max_results' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `maxResults` from the official Pulumi Cloud API operation. Maximum number of stacks to return per page',
  ),
  'organization' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization` from the official Pulumi Cloud API operation. Filter stacks to those owned by this organization',
  ),
  'project' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `project` from the official Pulumi Cloud API operation. Filter stacks to those in this project',
  ),
  'role_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `roleID` from the official Pulumi Cloud API operation. List stacks only using this custom role',
  ),
  'tag_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `tagName` from the official Pulumi Cloud API operation. Filter stacks by tag name (use with tagValue for exact match)',
  ),
  'tag_value' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `tagValue` from the official Pulumi Cloud API operation. Filter stacks by tag value (requires tagName)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/stacks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'maxResults' => 'max_results',
  'organization' => 'organization',
  'project' => 'project',
  'roleID' => 'role_id',
  'tagName' => 'tag_name',
  'tagValue' => 'tag_value',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
