<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Get project details.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentSlug}/projects/{projectName}.
 */
class SemgrepProjectsServiceGetProject extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_projects_service_get_project';
    protected const DESCRIPTION = 'Get project details

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentSlug}/projects/{projectName}

Retrieve details for a single project associated with a deployment that you have access to.';
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
    protected const METHOD = 'get';
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
