<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Bulk remove aliases from repository assets in group (Early Access).
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/assets/repository/aliases.
 */
class SnykDeleteAliasesInGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_aliases_in_group';
    protected const DESCRIPTION = 'Bulk remove aliases from repository assets in group (Early Access)

Official Snyk endpoint: DELETE /groups/{group_id}/assets/repository/aliases

Detach one or more aliased URLs from their canonical repository assets within a group. Each removed URL gets a new standalone asset document. #### Required permissions - `Edit Group Details (group.edit)`';
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
    protected const METHOD = 'delete';
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
