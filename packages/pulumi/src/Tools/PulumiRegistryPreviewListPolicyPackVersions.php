<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyPackVersions.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions.
 */
class PulumiRegistryPreviewListPolicyPackVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_list_policy_pack_versions';
    protected const DESCRIPTION = 'ListPolicyPackVersions

Official Pulumi Cloud endpoint: GET /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions

Lists all versions of a specific policy pack. The policy pack is identified by its source (currently only \'private\'), publisher organization, and name. The response includes a list of policy pack version metadata and an optional continuationToken for pagination. Returns 404 if the policy pack does not exist.';
    protected const PARAMETERS = array (
  'source' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `source` from the official Pulumi Cloud API operation. The policy pack source: \'private\'',
  ),
  'publisher' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `publisher` from the official Pulumi Cloud API operation. Organization that owns the policy pack',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Pulumi Cloud API operation. The policy pack name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/registry/policypacks/{source}/{publisher}/{name}/versions';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
