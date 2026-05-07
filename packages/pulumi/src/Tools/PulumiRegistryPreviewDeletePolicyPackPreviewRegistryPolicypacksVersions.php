<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePolicyPack.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}.
 */
class PulumiRegistryPreviewDeletePolicyPackPreviewRegistryPolicypacksVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_delete_policy_pack_preview_registry_policypacks_versions';
    protected const DESCRIPTION = 'DeletePolicyPack

Official Pulumi Cloud endpoint: DELETE /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}

Deletes a specific version of a policy pack from the registry. The policy pack version is identified by its source (currently only \'private\'), publisher organization, name, and semantic version string. Requires the RegistryPublish permission on the publisher organization. Returns 404 if the specified policy pack version does not exist.';
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
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string of the policy pack version to delete',
  ),
);
    protected const METHOD = 'delete';
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
