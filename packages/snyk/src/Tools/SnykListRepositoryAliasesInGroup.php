<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List repository aliases in group (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/assets/repository/aliases.
 */
class SnykListRepositoryAliasesInGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_repository_aliases_in_group';
    protected const DESCRIPTION = 'List repository aliases in group (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/assets/repository/aliases

Returns a paginated list of alias URL entries for repository assets within a group. Use the optional url filter to restrict results to a specific canonical document. #### Required permissions - `View Groups (group.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `url` from the official Snyk API operation. Optional repository URL filter - restricts results to the canonical document containing this URL',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Maximum number of alias items to return per page. A single canonical document with multiple aliases may span more than one page.',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return records after the record identified by this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return records before the record identified by this cursor',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/assets/repository/aliases';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'url' => 'url',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
