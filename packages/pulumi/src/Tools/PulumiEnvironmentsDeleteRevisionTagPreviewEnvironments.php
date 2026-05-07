<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteRevisionTag.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}.
 */
class PulumiEnvironmentsDeleteRevisionTagPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_delete_revision_tag_preview_environments';
    protected const DESCRIPTION = 'DeleteRevisionTag

Official Pulumi Cloud endpoint: DELETE /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}

Deletes a named revision tag from a Pulumi ESC environment. The tag is identified by its name in the URL path. After deletion, any imports or stack configurations referencing this tag will fail to resolve. The built-in \'latest\' tag cannot be deleted. Returns 204 on success with no response body.';
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
);
    protected const METHOD = 'delete';
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
