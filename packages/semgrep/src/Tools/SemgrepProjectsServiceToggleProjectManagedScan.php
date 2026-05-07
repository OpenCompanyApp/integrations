<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Toggle Managed Scans for a project.
 *
 * Maps to the official Semgrep Web API endpoint patch /api/v1/deployments/{deploymentSlug}/projects/{projectName}/managed-scan.
 */
class SemgrepProjectsServiceToggleProjectManagedScan extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_projects_service_toggle_project_managed_scan';
    protected const DESCRIPTION = 'Toggle Managed Scans for a project

Official Semgrep Web API endpoint: PATCH /api/v1/deployments/{deploymentSlug}/projects/{projectName}/managed-scan

Enable or disable
[Semgrep Managed Scans](/docs/deployment/managed-scanning/overview)
for a project.';
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
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/projects/{projectName}/managed-scan';
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
