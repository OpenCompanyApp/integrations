<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a team for this organization..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/teams/.
 */
class CloudsmithOrgsTeamsCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_create';
    protected const DESCRIPTION = 'Create a team for this organization.

Official Cloudsmith endpoint: POST /orgs/{org}/teams/

Create a team for this organization.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/teams/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
