<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Validate parameters for create MCP package.
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/validate-upload/mcp/.
 */
class CloudsmithPackagesValidateUploadMcp extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_validate_upload_mcp';
    protected const DESCRIPTION = 'Validate parameters for create MCP package

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/validate-upload/mcp/

Validate parameters for create MCP package';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/packages/{owner}/{repo}/validate-upload/mcp/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
