<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create or update pull request template for group.
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/settings/pull_request_template.
 */
class SnykCreateOrUpdatePullRequestTemplate extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_or_update_pull_request_template';
    protected const DESCRIPTION = 'Create or update pull request template for group

Official Snyk endpoint: POST /groups/{group_id}/settings/pull_request_template

Configures a group level pull request template that will be used on any org or project within that group #### Required permissions - `Edit Group settings (group.settings.edit)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Snyk Group ID',
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
    protected const PATH = '/groups/{group_id}/settings/pull_request_template';
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
