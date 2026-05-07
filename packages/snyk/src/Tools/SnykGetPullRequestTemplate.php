<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get pull request template for group.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/settings/pull_request_template.
 */
class SnykGetPullRequestTemplate extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_pull_request_template';
    protected const DESCRIPTION = 'Get pull request template for group

Official Snyk endpoint: GET /groups/{group_id}/settings/pull_request_template

Get your groups pull request template #### Required permissions - `View Group settings (group.settings.read)`';
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
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/settings/pull_request_template';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
