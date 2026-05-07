<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PostPublishPackageVersion.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/registry/packages/{source}/{publisher}/{name}/versions.
 */
class PulumiRegistryPreviewPostPublishPackageVersionPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_post_publish_package_version_preview';
    protected const DESCRIPTION = 'PostPublishPackageVersion

Official Pulumi Cloud endpoint: POST /api/preview/registry/packages/{source}/{publisher}/{name}/versions

Initiates the first step of a two-phase package version publish workflow. This creates a publish transaction and returns an operationID along with pre-signed upload URLs for the package artifacts (schema, index, and installationConfiguration). The caller must upload all required artifacts to the provided URLs and then call the PostPublishPackageVersionComplete endpoint with the operationID to finalize the publish. The request body must include the semantic version to publish. Returns 202 Accepted with the operation details, 404 if the source does not exist, or 409 if the specified version already exists.';
    protected const PARAMETERS = array (
  'source' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `source` from the official Pulumi Cloud API operation. The package source: \'pulumi\', \'opentofu\', or \'private\'',
  ),
  'publisher' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `publisher` from the official Pulumi Cloud API operation. Organization that owns the package',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Pulumi Cloud API operation. The package name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/registry/packages/{source}/{publisher}/{name}/versions';
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
