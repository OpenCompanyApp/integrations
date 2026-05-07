<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a new Terraform package.
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/upload/terraform/.
 */
class CloudsmithPackagesUploadTerraform extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_upload_terraform';
    protected const DESCRIPTION = 'Create a new Terraform package

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/upload/terraform/

Create a new Terraform package';
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
    protected const PATH = '/packages/{owner}/{repo}/upload/terraform/';
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
