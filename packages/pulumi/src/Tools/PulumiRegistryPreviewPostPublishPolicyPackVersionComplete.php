<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PostPublishPolicyPackVersionComplete.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}/complete.
 */
class PulumiRegistryPreviewPostPublishPolicyPackVersionComplete extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_post_publish_policy_pack_version_complete';
    protected const DESCRIPTION = 'PostPublishPolicyPackVersionComplete

Official Pulumi Cloud endpoint: POST /api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}/complete

Finalizes the second step of the two-phase policy pack version publish workflow. After initiating a publish with PostPublishPolicyPackVersion, call this endpoint with the policy pack source, publisher, name, and version to complete the publish and make the version available in the registry. Requires the RegistryPublish permission on the publisher organization. Returns 404 if the publish operation is not found.';
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
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string of the policy pack version to complete',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/registry/policypacks/{source}/{publisher}/{name}/versions/{version}/complete';
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
