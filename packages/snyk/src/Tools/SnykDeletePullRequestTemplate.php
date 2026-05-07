<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete pull request template for group.
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/settings/pull_request_template.
 */
class SnykDeletePullRequestTemplate extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_pull_request_template';
    protected const DESCRIPTION = 'Delete pull request template for group

Official Snyk endpoint: DELETE /groups/{group_id}/settings/pull_request_template

Delete your groups pull request template. This means Snyk pull requests will start to use the default template for this group. #### Required permissions - `Edit Group settings (group.settings.edit)`';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/groups/{group_id}/settings/pull_request_template';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
