<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePolicyPack.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/preview/registry/policypacks/{source}/{publisher}/{name}.
 */
class PulumiRegistryPreviewDeletePolicyPackPreviewRegistryPolicypacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_delete_policy_pack_preview_registry_policypacks';
    protected const DESCRIPTION = 'DeletePolicyPack

Official Pulumi Cloud endpoint: DELETE /api/preview/registry/policypacks/{source}/{publisher}/{name}

Deletes a policy pack and all of its versions from the registry. The policy pack is identified by its source (currently only \'private\'), publisher organization, and name. This is a destructive operation that permanently removes the policy pack and all associated version data. Requires the RegistryPublish permission on the publisher organization. Returns 404 if the policy pack does not exist.';
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/preview/registry/policypacks/{source}/{publisher}/{name}';
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
