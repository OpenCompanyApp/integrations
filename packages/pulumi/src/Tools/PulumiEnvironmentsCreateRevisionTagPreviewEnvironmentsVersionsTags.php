<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateRevisionTag.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}.
 */
class PulumiEnvironmentsCreateRevisionTagPreviewEnvironmentsVersionsTags extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_revision_tag_preview_environments_versions_tags';
    protected const DESCRIPTION = 'CreateRevisionTag

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}

Creates a new revision tag for a Pulumi ESC environment. Revision tags are named references that point to specific revision numbers, similar to Git tags. They allow pinning a stable reference to a known-good version of an environment. Tagged versions can be used in imports and Pulumi stack configuration (e.g., myproject/env@prod) to ensure stable references unaffected by subsequent changes. The built-in \'latest\' tag always points to the most recent revision.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'tag_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tagName` from the official Pulumi Cloud API operation. The revision tag name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
  'tagName' => 'tag_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
