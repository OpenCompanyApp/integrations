<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateRevisionTag.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/versions/tags.
 */
class PulumiEnvironmentsCreateRevisionTagEscEnvironmentsVersionsTags extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_revision_tag_esc_environments_versions_tags';
    protected const DESCRIPTION = 'CreateRevisionTag

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/versions/tags

Creates a new revision tag for a Pulumi ESC environment. Revision tags are named references that point to specific revision numbers, similar to Git tags. They allow pinning a stable reference to a known-good version of an environment. Tagged versions can be used in imports and Pulumi stack configuration (e.g., myproject/env@prod) to ensure stable references unaffected by subsequent changes. The built-in \'latest\' tag always points to the most recent revision.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/versions/tags';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
