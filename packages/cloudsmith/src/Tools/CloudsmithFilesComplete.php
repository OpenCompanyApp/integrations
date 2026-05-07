<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Complete a multipart file upload..
 *
 * Maps to the official Cloudsmith endpoint post /files/{owner}/{repo}/{identifier}/complete/.
 */
class CloudsmithFilesComplete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_files_complete';
    protected const DESCRIPTION = 'Complete a multipart file upload.

Official Cloudsmith endpoint: POST /files/{owner}/{repo}/{identifier}/complete/

Complete a multipart file upload.';
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
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/files/{owner}/{repo}/{identifier}/complete/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
