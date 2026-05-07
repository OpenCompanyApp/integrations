<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePublishPackageVersion.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/registry/packages/{source}/{publisher}/{name}/versions/{version}.
 */
class PulumiRegistryDeletePublishPackageVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_delete_publish_package_version';
    protected const DESCRIPTION = 'DeletePublishPackageVersion

Official Pulumi Cloud endpoint: DELETE /api/registry/packages/{source}/{publisher}/{name}/versions/{version}

Removes a specific version of a package from the registry. The package is identified by its source (e.g. \'pulumi\', \'opentofu\', or \'private\'), publisher organization, name, and semantic version. Requires the RegistryPublish permission on the publisher organization. Returns 204 No Content on success.';
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
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string of the package version to delete',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/registry/packages/{source}/{publisher}/{name}/versions/{version}';
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
