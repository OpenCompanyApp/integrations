<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyPackVersion.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}.
 */
class PulumiRegistryPreviewGetPolicyPackVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_get_policy_pack_version';
    protected const DESCRIPTION = 'GetPolicyPackVersion

Official Pulumi Cloud endpoint: GET /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}

Retrieves detailed information about a specific version of a policy pack, including the individual policy definitions. The policy pack is identified by its source (currently only \'private\'), publisher organization, and name. The version parameter accepts either a specific semantic version string or the special value \'latest\' to retrieve the most recently published version. The response includes the policy pack metadata and an optional list of policies, where each policy includes its configuration schema and enforcement rules. Returns 404 if the specified policy pack does not exist.';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string or \'latest\'',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
