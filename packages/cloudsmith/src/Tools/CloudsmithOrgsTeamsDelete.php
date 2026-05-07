<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a specific team in a organization..
 *
 * Maps to the official Cloudsmith endpoint delete /orgs/{org}/teams/{team}/.
 */
class CloudsmithOrgsTeamsDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_delete';
    protected const DESCRIPTION = 'Delete a specific team in a organization.

Official Cloudsmith endpoint: DELETE /orgs/{org}/teams/{team}/

Delete a specific team in a organization.';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org}/teams/{team}/';
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
