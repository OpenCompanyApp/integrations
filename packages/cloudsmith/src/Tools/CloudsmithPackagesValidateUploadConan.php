<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Validate parameters for create Conan package.
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/validate-upload/conan/.
 */
class CloudsmithPackagesValidateUploadConan extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_validate_upload_conan';
    protected const DESCRIPTION = 'Validate parameters for create Conan package

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/validate-upload/conan/

Validate parameters for create Conan package';
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
    protected const PATH = '/packages/{owner}/{repo}/validate-upload/conan/';
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
