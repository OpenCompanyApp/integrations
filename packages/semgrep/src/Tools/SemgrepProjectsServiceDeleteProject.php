<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Delete project.
 *
 * Maps to the official Semgrep Web API endpoint delete /api/v1/deployments/{deploymentSlug}/projects/{projectName}.
 */
class SemgrepProjectsServiceDeleteProject extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_projects_service_delete_project';
    protected const DESCRIPTION = 'Delete project

Official Semgrep Web API endpoint: DELETE /api/v1/deployments/{deploymentSlug}/projects/{projectName}

Delete a project for a deployment you have access to. This will also delete all of the associated findings.';
    protected const PARAMETERS = array (
  'deployment_slug' =>
  array (
    'type' => 'string',
    'description' => 'deploymentSlug parameter.',
    'required' => true,
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'description' => 'projectName parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/projects/{projectName}';
    protected const PATH_PARAMS = array (
  'deploymentSlug' => 'deployment_slug',
  'projectName' => 'project_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
