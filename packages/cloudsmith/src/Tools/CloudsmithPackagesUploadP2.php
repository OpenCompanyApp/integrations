<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a new P2 package.
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/upload/p2/.
 */
class CloudsmithPackagesUploadP2 extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_upload_p2';
    protected const DESCRIPTION = 'Create a new P2 package

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/upload/p2/

Create a new P2 package';
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
    protected const PATH = '/packages/{owner}/{repo}/upload/p2/';
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
