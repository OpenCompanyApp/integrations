<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PostPublishTemplateVersion.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/registry/templates/{source}/{publisher}/{name}/versions.
 */
class PulumiRegistryPreviewPostPublishTemplateVersionPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_post_publish_template_version_preview';
    protected const DESCRIPTION = 'PostPublishTemplateVersion

Official Pulumi Cloud endpoint: POST /api/preview/registry/templates/{source}/{publisher}/{name}/versions

Initiates the first step of a two-phase template version publish workflow. This creates a publish transaction and returns an operationID along with a pre-signed upload URL for the template archive. The source must be \'private\'. The caller must upload the template archive (a gzip-compressed tar file containing a root-level Pulumi.yaml with a template section, and optionally a README.md) to the provided URL, then call PostPublishTemplateVersionComplete with the operationID to finalize the publish. The request body must include the semantic version to publish. Returns 202 Accepted with the operation details, or 404 if the source does not exist.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/registry/templates/{source}/{publisher}/{name}/versions';
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
