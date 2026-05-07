<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PostPublishTemplateVersionComplete.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/registry/templates/{source}/{publisher}/{name}/versions/{version}/complete.
 */
class PulumiRegistryPreviewPostPublishTemplateVersionCompletePreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_post_publish_template_version_complete_preview';
    protected const DESCRIPTION = 'PostPublishTemplateVersionComplete

Official Pulumi Cloud endpoint: POST /api/preview/registry/templates/{source}/{publisher}/{name}/versions/{version}/complete

Finalizes the second step of the two-phase template version publish workflow. After initiating a publish with PostPublishTemplateVersion and uploading the template archive (.tar.gz) to the pre-signed URL, call this endpoint with the operationID to complete the publish. The service validates that the archive was uploaded successfully before making the version available in the registry. Once complete, the template becomes available to the publisher\'s organization. Returns 201 Created on success, 400 for invalid operation state, 404 if the publish operation is not found, or 409 if the version already exists.';
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
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. Semantic version string of the template version to complete',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/registry/templates/{source}/{publisher}/{name}/versions/{version}/complete';
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
