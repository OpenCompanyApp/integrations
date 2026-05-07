<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Remove tags from project.
 *
 * Maps to the official Semgrep Web API endpoint delete /api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags.
 */
class SemgrepProjectsServiceDeleteProjectTags extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_projects_service_delete_project_tags';
    protected const DESCRIPTION = 'Remove tags from project

Official Semgrep Web API endpoint: DELETE /api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags

Remove tags from a project for a deployment you have access to.

This request will not delete project tags from the deployment and will only remove
them from the requested project. Any other projects associated with the requested
tag will remain unaffected.';
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
  'tags' =>
  array (
    'type' => 'array',
    'description' => 'tags parameter.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags';
    protected const PATH_PARAMS = array (
  'deploymentSlug' => 'deployment_slug',
  'projectName' => 'project_name',
);
    protected const QUERY_PARAMS = array (
  'tags' => 'tags',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
