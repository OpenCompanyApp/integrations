<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get individual user learning progress (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/learn/progress/users.
 */
class SnykGetUsersProgress extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_users_progress';
    protected const DESCRIPTION = 'Get individual user learning progress (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/learn/progress/users

Retrieves detailed learning progress status per user, including completion dates and history for each catalog resource. #### Required permissions - `View Organization Snyk Learn Reports (org.learn_report.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The unique identifier of the organization.',
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
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Snyk API operation. Filter by the learn catalog resource type',
    'enum' =>
    array (
      0 => 'learning_path',
      1 => 'lesson',
    ),
  ),
  'title' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `title` from the official Snyk API operation. This is deprecated, use Titles instead',
  ),
  'titles' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `titles` from the official Snyk API operation. Filter by the title of the learning path or lesson resource',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Snyk API operation. Filter by progress status of the resources',
    'enum' =>
    array (
      0 => 'completed',
      1 => 'inProgress',
    ),
  ),
  'emails' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `emails` from the official Snyk API operation. Filter by user email addresses',
  ),
  'completion_interval' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `completion_interval` from the official Snyk API operation. Filter by date interval in ISO 8601 format (e.g. 2024-01-01/2024-02-01)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/learn/progress/users';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'type' => 'type',
  'title' => 'title',
  'titles' => 'titles',
  'status' => 'status',
  'emails' => 'emails',
  'completion_interval' => 'completion_interval',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
