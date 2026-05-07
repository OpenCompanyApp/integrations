<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Set the active RSA key for the Repository..
 *
 * Maps to the official Cloudsmith endpoint post /repos/{owner}/{identifier}/rsa/.
 */
class CloudsmithReposRsaCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_rsa_create';
    protected const DESCRIPTION = 'Set the active RSA key for the Repository.

Official Cloudsmith endpoint: POST /repos/{owner}/{identifier}/rsa/

Set the active RSA key for the Repository.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
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
