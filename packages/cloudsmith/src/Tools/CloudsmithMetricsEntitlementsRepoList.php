<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * View for listing entitlement token metrics, for a repository..
 *
 * Maps to the official Cloudsmith endpoint get /metrics/entitlements/{owner}/{repo}/.
 */
class CloudsmithMetricsEntitlementsRepoList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_metrics_entitlements_repo_list';
    protected const DESCRIPTION = 'View for listing entitlement token metrics, for a repository.

Official Cloudsmith endpoint: GET /metrics/entitlements/{owner}/{repo}/

View for listing entitlement token metrics, for a repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
  'finish' => array (
  'type' => 'string',
  'description' => 'Include metrics upto and including this UTC date or UTC datetime. For example \'2020-12-31\' or \'2021-12-13T00:00:00Z\'.',
),
  'start' => array (
  'type' => 'string',
  'description' => 'Include metrics from and including this UTC date or UTC datetime. For example \'2020-12-31\' or \'2021-12-13T00:00:00Z\'.',
),
  'tokens' => array (
  'type' => 'string',
  'description' => 'A comma seperated list of tokens (slug perm) to include in the results.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/metrics/entitlements/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'finish' => 'finish',
  'start' => 'start',
  'tokens' => 'tokens',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
