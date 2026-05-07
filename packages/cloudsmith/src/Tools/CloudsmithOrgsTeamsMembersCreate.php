<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Add users to a team..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/teams/{team}/members.
 */
class CloudsmithOrgsTeamsMembersCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_members_create';
    protected const DESCRIPTION = 'Add users to a team.

Official Cloudsmith endpoint: POST /orgs/{org}/teams/{team}/members

Add users to a team.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'team' => array (
  'type' => 'string',
  'description' => 'team parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/teams/{team}/members';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'team' => 'team',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
