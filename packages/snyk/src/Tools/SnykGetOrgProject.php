<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get project by project ID..
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/projects/{project_id}.
 */
class SnykGetOrgProject extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_org_project';
    protected const DESCRIPTION = 'Get project by project ID.

Official Snyk endpoint: GET /orgs/{org_id}/projects/{project_id}

Get one project of the organization by project ID. #### Required permissions - `View Projects (org.project.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the org to which the project belongs to.',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `project_id` from the official Snyk API operation. The ID of the project.',
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/projects/{project_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'expand' => 'expand',
  'meta.latest_issue_counts' => 'meta_latest_issue_counts',
  'meta.latest_dependency_total' => 'meta_latest_dependency_total',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
