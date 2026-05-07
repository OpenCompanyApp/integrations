<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Regenerate ECDSA Key for the Repository..
 *
 * Maps to the official Cloudsmith endpoint post /repos/{owner}/{identifier}/ecdsa/regenerate/.
 */
class CloudsmithReposEcdsaRegenerate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_ecdsa_regenerate';
    protected const DESCRIPTION = 'Regenerate ECDSA Key for the Repository.

Official Cloudsmith endpoint: POST /repos/{owner}/{identifier}/ecdsa/regenerate/

Regenerate ECDSA Key for the Repository.';
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
    protected const METHOD = 'post';
    protected const PATH = '/repos/{owner}/{identifier}/ecdsa/regenerate/';
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
