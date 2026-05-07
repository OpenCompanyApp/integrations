<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetTemplateVersion.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/registry/templates/{source}/{publisher}/{name}/versions/{version}.
 */
class PulumiRegistryPreviewGetTemplateVersionPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_get_template_version_preview';
    protected const DESCRIPTION = 'GetTemplateVersion

Official Pulumi Cloud endpoint: GET /api/preview/registry/templates/{source}/{publisher}/{name}/versions/{version}

Retrieves metadata for a specific version of a registry template. The template is identified by its source (e.g. \'private\', \'github\', or \'gitlab\'), publisher organization, and name. The version parameter accepts either a specific semantic version string or the special value \'latest\' to retrieve the most recent version. The response includes the template\'s name, display name, description, runtime information, language, readme URL, download URL (a pre-signed URL valid for at least 5 minutes for retrieving the .tar.gz archive), repository slug (for VCS-backed templates), visibility, updated timestamp, metadata, and configuration values. Returns 400 if a specific version is provided for VCS-backed templates (which do not support versioning), or 404 if the template version does not exist.';
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
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string or \'latest\'',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/registry/templates/{source}/{publisher}/{name}/versions/{version}';
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
