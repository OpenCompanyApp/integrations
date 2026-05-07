<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Transfer a repository to a different region..
 *
 * Maps to the official Cloudsmith endpoint post /repos/{owner}/{repo}/transfer-region/.
 */
class CloudsmithReposTransferRegion extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_transfer_region';
    protected const DESCRIPTION = 'Transfer a repository to a different region.

Official Cloudsmith endpoint: POST /repos/{owner}/{repo}/transfer-region/

Transfer a repository to a different region.';
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
    protected const PATH = '/repos/{owner}/{repo}/transfer-region/';
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
