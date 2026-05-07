<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateRevisionTag.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}.
 */
class PulumiEnvironmentsUpdateRevisionTagPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_update_revision_tag_preview_environments';
    protected const DESCRIPTION = 'UpdateRevisionTag

Official Pulumi Cloud endpoint: PATCH /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}

Updates an existing revision tag for a Pulumi ESC environment to point to a different revision number. The tag is identified by its name in the URL path. The request body specifies the new revision number. This allows advancing or rolling back a named reference (e.g., moving the \'prod\' tag to a newer or older revision). Returns 204 on success with no response body.';
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
    protected const METHOD = 'patch';
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
