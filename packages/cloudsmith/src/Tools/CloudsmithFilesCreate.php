<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Request URL(s) to upload new package file upload(s) to..
 *
 * Maps to the official Cloudsmith endpoint post /files/{owner}/{repo}/.
 */
class CloudsmithFilesCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_files_create';
    protected const DESCRIPTION = 'Request URL(s) to upload new package file upload(s) to.

Official Cloudsmith endpoint: POST /files/{owner}/{repo}/

Request URL(s) to upload new package file upload(s) to.';
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
    protected const PATH = '/files/{owner}/{repo}/';
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
