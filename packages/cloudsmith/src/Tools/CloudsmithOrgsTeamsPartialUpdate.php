<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a specific team in a organization..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/teams/{team}/.
 */
class CloudsmithOrgsTeamsPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_partial_update';
    protected const DESCRIPTION = 'Update a specific team in a organization.

Official Cloudsmith endpoint: PATCH /orgs/{org}/teams/{team}/

Update a specific team in a organization.';
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
    protected const METHOD = 'patch';
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
