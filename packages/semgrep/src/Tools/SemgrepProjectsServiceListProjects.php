<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * List all projects.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/deployments/{deploymentSlug}/projects.
 */
class SemgrepProjectsServiceListProjects extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_projects_service_list_projects';
    protected const DESCRIPTION = 'List all projects

Official Semgrep Web API endpoint: GET /api/v1/deployments/{deploymentSlug}/projects

Request the list of projects that have been scanned or onboarded to Managed Scans. Does not return archived repositories. Returns 100 projects per page by default.';
    protected const PARAMETERS = array (
  'deployment_slug' =>
  array (
    'type' => 'string',
    'description' => 'deploymentSlug parameter.',
    'required' => true,
  ),
  'page' =>
  array (
    'type' => 'number',
    'description' => 'page parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'number',
    'description' => 'page_size parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/projects';
    protected const PATH_PARAMS = array (
  'deploymentSlug' => 'deployment_slug',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
