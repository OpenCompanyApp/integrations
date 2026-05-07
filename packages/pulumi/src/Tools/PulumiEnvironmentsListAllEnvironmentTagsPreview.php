<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAllEnvironmentTags.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/tags.
 */
class PulumiEnvironmentsListAllEnvironmentTagsPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_all_environment_tags_preview';
    protected const DESCRIPTION = 'ListAllEnvironmentTags

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/tags

Returns a map of all unique tag names and their distinct values across all Pulumi ESC environments in the organization. The response is a map where each key is a tag name and the value is a list of all distinct values for that tag across all environments. This is useful for building tag-based filtering or discovery UIs.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/environments/{orgName}/tags';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
