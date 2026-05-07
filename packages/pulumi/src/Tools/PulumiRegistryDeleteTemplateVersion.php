<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteTemplateVersion.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/registry/templates/{source}/{publisher}/{name}/versions/{version}.
 */
class PulumiRegistryDeleteTemplateVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_delete_template_version';
    protected const DESCRIPTION = 'DeleteTemplateVersion

Official Pulumi Cloud endpoint: DELETE /api/registry/templates/{source}/{publisher}/{name}/versions/{version}

Removes a specific version of a template from the registry. The template is identified by its source (e.g. \'private\', \'github\', or \'gitlab\'), publisher organization, name, and semantic version. If this is the last remaining version of the template, the \'force\' query parameter must be set to true; doing so will also delete the template itself. Returns 204 No Content on success, or 400 if an invalid query parameter is provided.';
    protected const PARAMETERS = array (
  'source' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `source` from the official Pulumi Cloud API operation. The template source: \'private\', \'github\', or \'gitlab\'',
  ),
  'publisher' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `publisher` from the official Pulumi Cloud API operation. Organization that owns the template',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Pulumi Cloud API operation. The template name',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string of the template version to delete',
  ),
  'force' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `force` from the official Pulumi Cloud API operation. When true, allows deletion of the final remaining template version',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/registry/templates/{source}/{publisher}/{name}/versions/{version}';
    protected const PATH_PARAMS = array (
  'source' => 'source',
  'publisher' => 'publisher',
  'name' => 'name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'force' => 'force',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
