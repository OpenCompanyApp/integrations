<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * List all members for the team..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/teams/{team}/members.
 */
class CloudsmithOrgsTeamsMembersList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_members_list';
    protected const DESCRIPTION = 'List all members for the team.

Official Cloudsmith endpoint: GET /orgs/{org}/teams/{team}/members

List all members for the team.';
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
  'user_kind' => array (
  'type' => 'string',
  'description' => 'Filter accounts by type. Possible values are \'user\' and \'service\'. If not provided, only users are returned.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/teams/{team}/members';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'team' => 'team',
);
    protected const QUERY_PARAMS = array (
  'user_kind' => 'user_kind',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
