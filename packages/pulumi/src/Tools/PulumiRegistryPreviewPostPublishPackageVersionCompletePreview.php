<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PostPublishPackageVersionComplete.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/registry/packages/{source}/{publisher}/{name}/versions/{version}/complete.
 */
class PulumiRegistryPreviewPostPublishPackageVersionCompletePreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_post_publish_package_version_complete_preview';
    protected const DESCRIPTION = 'PostPublishPackageVersionComplete

Official Pulumi Cloud endpoint: POST /api/preview/registry/packages/{source}/{publisher}/{name}/versions/{version}/complete

Finalizes the second step of the two-phase package version publish workflow. After initiating a publish with PostPublishPackageVersion and uploading all required artifacts (schema, index, installationConfiguration) to the pre-signed URLs, call this endpoint with the operationID to complete the publish. The service validates that all artifacts were uploaded successfully before making the version available in the registry. Returns 201 Created on success, 400 for a bad request (e.g. missing artifacts), 404 if the publish operation is not found, or 409 if the version already exists.';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string of the package version to complete',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/registry/packages/{source}/{publisher}/{name}/versions/{version}/complete';
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
