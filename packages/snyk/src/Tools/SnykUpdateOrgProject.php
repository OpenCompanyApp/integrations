<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Updates project by project ID..
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/projects/{project_id}.
 */
class SnykUpdateOrgProject extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_project';
    protected const DESCRIPTION = 'Updates project by project ID.

Official Snyk endpoint: PATCH /orgs/{org_id}/projects/{project_id}

Updates one project of the organization by project ID. #### Required permissions - `View Organization (org.read)` - `View Projects (org.project.read)` - `Edit Projects (org.project.edit)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the Org the project belongs to.',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `project_id` from the official Snyk API operation. The ID of the project to patch.',
  ),
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand` from the official Snyk API operation. Expand relationships.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/projects/{project_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'expand' => 'expand',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
