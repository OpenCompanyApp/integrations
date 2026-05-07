<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Profiles.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/projects/{project_id}/profiles/.
 */
class DbtCloudV3ListProfiles extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_profiles';
    protected const DESCRIPTION = 'List Profiles

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/projects/{project_id}/profiles/

List profiles.

Note: Profiles are in the process of being rolled out and may not be available for your account yet.

Profiles are the set of connection, credentials, and attributes used to connect to a data warehouse. They can be assigned to deployment environments to run jobs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'connection_id' =>
  array (
    'type' => 'integer',
    'description' => 'The ID of the connection for the profile',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
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
  'profile_ids' =>
  array (
    'type' => 'string',
    'description' => 'A list of profile IDs to fetch',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/profiles/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'connection_id' => 'connection_id',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
  'profile_ids' => 'profile_ids',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
