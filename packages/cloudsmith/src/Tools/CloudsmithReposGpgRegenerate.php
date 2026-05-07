<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Regenerate GPG Key for the Repository..
 *
 * Maps to the official Cloudsmith endpoint post /repos/{owner}/{identifier}/gpg/regenerate/.
 */
class CloudsmithReposGpgRegenerate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_repos_gpg_regenerate';
    protected const DESCRIPTION = 'Regenerate GPG Key for the Repository.

Official Cloudsmith endpoint: POST /repos/{owner}/{identifier}/gpg/regenerate/

Regenerate GPG Key for the Repository.';
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
    protected const PATH = '/repos/{owner}/{identifier}/gpg/regenerate/';
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
