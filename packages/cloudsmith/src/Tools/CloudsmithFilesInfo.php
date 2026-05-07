<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get upload information to perform a multipart file upload..
 *
 * Maps to the official Cloudsmith endpoint get /files/{owner}/{repo}/{identifier}/info/.
 */
class CloudsmithFilesInfo extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_files_info';
    protected const DESCRIPTION = 'Get upload information to perform a multipart file upload.

Official Cloudsmith endpoint: GET /files/{owner}/{repo}/{identifier}/info/

Get upload information to perform a multipart file upload.';
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
  'filename' => array (
  'type' => 'string',
  'description' => 'The filename of the file being uploaded',
  'required' => true,
),
  'part_number' => array (
  'type' => 'string',
  'description' => 'The part number to be uploaded next',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/files/{owner}/{repo}/{identifier}/info/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
  'filename' => 'filename',
  'part_number' => 'part_number',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
