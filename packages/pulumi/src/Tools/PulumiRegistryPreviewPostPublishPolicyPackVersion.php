<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PostPublishPolicyPackVersion.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions.
 */
class PulumiRegistryPreviewPostPublishPolicyPackVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_post_publish_policy_pack_version';
    protected const DESCRIPTION = 'PostPublishPolicyPackVersion

Official Pulumi Cloud endpoint: POST /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions

Initiates the first step of a two-phase policy pack version publish workflow. The policy pack is identified by its source (currently only \'private\'), publisher organization, and name. This creates a publish transaction that must be completed by calling PostPublishPolicyPackVersionComplete. Requires the RegistryPublish permission on the publisher organization. Returns 404 if the policy pack is not found.';
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
    protected const METHOD = 'post';
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
