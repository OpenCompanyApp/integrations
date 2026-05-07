<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadRevisionTag.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}.
 */
class PulumiEnvironmentsReadRevisionTagPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_read_revision_tag_preview_environments';
    protected const DESCRIPTION = 'ReadRevisionTag

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/versions/tags/{tagName}

Returns the details of a specific revision tag for a Pulumi ESC environment. The tag is identified by its name in the URL path. The response includes the tag name and the revision number it points to. Returns 404 if the tag does not exist.';
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
    protected const METHOD = 'get';
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
