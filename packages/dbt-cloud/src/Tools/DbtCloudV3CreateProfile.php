<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Profile.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/projects/{project_id}/profiles/.
 */
class DbtCloudV3CreateProfile extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_profile';
    protected const DESCRIPTION = 'Create Profile

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/projects/{project_id}/profiles/

Create a new profile.

Note: Profiles are in the process of being rolled out and may not be available for your account yet.

Profiles are the set of connection, credentials, and attributes used to connect to a data warehouse. They can be assigned to deployment environments to run jobs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'The maximum number of items to return.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'The number of items to skip before starting to collect the result set.',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/profiles/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'limit' => 'limit',
  'offset' => 'offset',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
