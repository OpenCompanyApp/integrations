<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete project by project ID..
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/projects/{project_id}.
 */
class SnykDeleteOrgProject extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_org_project';
    protected const DESCRIPTION = 'Delete project by project ID.

Official Snyk endpoint: DELETE /orgs/{org_id}/projects/{project_id}

Delete one project in the organization by project ID. #### Required permissions - `View Organization (org.read)` - `View Projects (org.project.read)` - `Remove Projects (org.project.delete)`';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/projects/{project_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
