<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List all Projects for an Org with the given Org ID..
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/projects.
 */
class SnykListOrgProjects extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_org_projects';
    protected const DESCRIPTION = 'List all Projects for an Org with the given Org ID.

Official Snyk endpoint: GET /orgs/{org_id}/projects

List all Projects for an Org. #### Required permissions - `View Projects (org.project.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the org that the projects belong to.',
  ),
  'target_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `target_id` from the official Snyk API operation. Return projects that belong to the provided targets',
  ),
  'target_reference' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `target_reference` from the official Snyk API operation. Return projects that match the provided target reference',
  ),
  'target_file' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `target_file` from the official Snyk API operation. Return projects that match the provided target file',
  ),
  'target_runtime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `target_runtime` from the official Snyk API operation. Return projects that match the provided target runtime',
  ),
  'meta_count' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `meta_count` from the official Snyk API operation. The collection count.',
    'enum' =>
    array (
      0 => 'only',
    ),
  ),
  'ids' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `ids` from the official Snyk API operation. Return projects that match the provided IDs.',
  ),
  'names' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `names` from the official Snyk API operation. Return projects that match the provided names.',
  ),
  'names_start_with' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `names_start_with` from the official Snyk API operation. Return projects with names starting with the specified prefix.',
  ),
  'origins' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `origins` from the official Snyk API operation. Return projects that match the provided origins.',
  ),
  'types' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `types` from the official Snyk API operation. Return projects that match the provided types.',
  ),
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand` from the official Snyk API operation. Expand relationships.',
  ),
  'meta_latest_issue_counts' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `meta.latest_issue_counts` from the official Snyk API operation. Include a summary count for the issues found in the most recent scan of this project',
  ),
  'meta_latest_dependency_total' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `meta.latest_dependency_total` from the official Snyk API operation. Include the total number of dependencies found in the most recent scan of this project',
  ),
  'cli_monitored_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cli_monitored_before` from the official Snyk API operation. Filter projects uploaded and monitored before this date (encoded value)',
  ),
  'cli_monitored_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cli_monitored_after` from the official Snyk API operation. Filter projects uploaded and monitored after this date (encoded value)',
  ),
  'importing_user_public_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `importing_user_public_id` from the official Snyk API operation. Return projects that match the provided importing user public ids.',
  ),
  'tags' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `tags` from the official Snyk API operation. Return projects that match all the provided tags',
  ),
  'business_criticality' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `business_criticality` from the official Snyk API operation. Return projects that match all the provided business_criticality value',
  ),
  'environment' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `environment` from the official Snyk API operation. Return projects that match all the provided environment values',
  ),
  'lifecycle' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `lifecycle` from the official Snyk API operation. Return projects that match all the provided lifecycle values',
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
    protected const PATH = '/orgs/{org_id}/projects';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'target_id' => 'target_id',
  'target_reference' => 'target_reference',
  'target_file' => 'target_file',
  'target_runtime' => 'target_runtime',
  'meta_count' => 'meta_count',
  'ids' => 'ids',
  'names' => 'names',
  'names_start_with' => 'names_start_with',
  'origins' => 'origins',
  'types' => 'types',
  'expand' => 'expand',
  'meta.latest_issue_counts' => 'meta_latest_issue_counts',
  'meta.latest_dependency_total' => 'meta_latest_dependency_total',
  'cli_monitored_before' => 'cli_monitored_before',
  'cli_monitored_after' => 'cli_monitored_after',
  'importing_user_public_id' => 'importing_user_public_id',
  'tags' => 'tags',
  'business_criticality' => 'business_criticality',
  'environment' => 'environment',
  'lifecycle' => 'lifecycle',
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
