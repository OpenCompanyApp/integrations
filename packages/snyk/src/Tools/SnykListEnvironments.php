<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List Environments (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/cloud/environments.
 */
class SnykListEnvironments extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_environments';
    protected const DESCRIPTION = 'List Environments (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/cloud/environments

List environments for an organization #### Required permissions - `View environments (org.cloud_environments.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Organization ID',
  ),
  'created_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_after` from the official Snyk API operation. Return environments created after this date',
  ),
  'created_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_before` from the official Snyk API operation. Return environments created before this date',
  ),
  'updated_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_after` from the official Snyk API operation. Return environments updated after this date',
  ),
  'updated_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_before` from the official Snyk API operation. Return environments updated before this date',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Snyk API operation. Filter environments by name (multi-value, comma-separated)',
  ),
  'kind' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `kind` from the official Snyk API operation. Filter environments by kind (multi-value, comma-separated): aws',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Snyk API operation. Filter environments by latest scan status (multi-value, comma-separated)',
    'enum' =>
    array (
      0 => 'queued',
      1 => 'in_progress',
      2 => 'success',
      3 => 'error',
      4 => 'null',
    ),
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `id` from the official Snyk API operation. Filter environments by environment ID (multi-value, comma-separated)',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `project_id` from the official Snyk API operation. Filter environments by project ID',
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
    protected const PATH = '/orgs/{org_id}/cloud/environments';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'created_after' => 'created_after',
  'created_before' => 'created_before',
  'updated_after' => 'updated_after',
  'updated_before' => 'updated_before',
  'name' => 'name',
  'kind' => 'kind',
  'status' => 'status',
  'id' => 'id',
  'project_id' => 'project_id',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
