<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Add alias for a repository asset in group (Early Access).
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/assets/repository/aliases.
 */
class SnykCreateAliasInGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_alias_in_group';
    protected const DESCRIPTION = 'Add alias for a repository asset in group (Early Access)

Official Snyk endpoint: POST /groups/{group_id}/assets/repository/aliases

Link one or more alternate repository URLs to a canonical repository asset within a group, enabling alias-aware asset lookup. #### Required permissions - `Edit Group Details (group.edit)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/assets/repository/aliases';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
