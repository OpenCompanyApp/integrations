<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Update project details.
 *
 * Maps to the official Semgrep Web API endpoint patch /api/v1/deployments/{deploymentSlug}/projects/{projectName}.
 */
class SemgrepProjectsServiceUpdateProject extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_projects_service_update_project';
    protected const DESCRIPTION = 'Update project details

Official Semgrep Web API endpoint: PATCH /api/v1/deployments/{deploymentSlug}/projects/{projectName}

Update attributes for the project using the value passed in to the request body.

Note: The only attribute that is supported as of January 2023 is `tags`.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Semgrep Web API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/projects/{projectName}';
    protected const PATH_PARAMS = array (
  'deploymentSlug' => 'deployment_slug',
  'projectName' => 'project_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
