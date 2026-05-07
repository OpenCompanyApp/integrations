<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve the active RSA key for the Repository..
 *
 * Maps to the official Cloudsmith endpoint get /repos/{owner}/{identifier}/rsa/.
 */
class CloudsmithReposRsaList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_rsa_list';
    protected const DESCRIPTION = 'Retrieve the active RSA key for the Repository.

Official Cloudsmith endpoint: GET /repos/{owner}/{identifier}/rsa/

Retrieve the active RSA key for the Repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/repos/{owner}/{identifier}/rsa/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
