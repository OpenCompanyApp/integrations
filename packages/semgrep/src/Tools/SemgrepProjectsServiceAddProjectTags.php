<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Add tags to project.
 *
 * Maps to the official Semgrep Web API endpoint put /api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags.
 */
class SemgrepProjectsServiceAddProjectTags extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_projects_service_add_project_tags';
    protected const DESCRIPTION = 'Add tags to project

Official Semgrep Web API endpoint: PUT /api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags

Add tags to a project for a deployment you have access to.

Any project tags that do not already exist for the deployment will be created automatically and associated with the project.';
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
    protected const METHOD = 'put';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/projects/{projectName}/tags';
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
