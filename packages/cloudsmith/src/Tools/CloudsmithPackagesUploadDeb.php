<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a new Debian package.
 *
 * Maps to the official Cloudsmith endpoint post /packages/{owner}/{repo}/upload/deb/.
 */
class CloudsmithPackagesUploadDeb extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_packages_upload_deb';
    protected const DESCRIPTION = 'Create a new Debian package

Official Cloudsmith endpoint: POST /packages/{owner}/{repo}/upload/deb/

Create a new Debian package';
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
    protected const PATH = '/packages/{owner}/{repo}/upload/deb/';
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
