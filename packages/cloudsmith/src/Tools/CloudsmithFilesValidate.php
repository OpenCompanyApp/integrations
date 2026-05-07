<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Validate parameters used for create..
 *
 * Maps to the official Cloudsmith endpoint post /files/{owner}/{repo}/validate/.
 */
class CloudsmithFilesValidate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_files_validate';
    protected const DESCRIPTION = 'Validate parameters used for create.

Official Cloudsmith endpoint: POST /files/{owner}/{repo}/validate/

Validate parameters used for create.';
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
    protected const PATH = '/files/{owner}/{repo}/validate/';
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
