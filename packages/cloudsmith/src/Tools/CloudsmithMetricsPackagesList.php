<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * View for listing package usage metrics, for a repository..
 *
 * Maps to the official Cloudsmith endpoint get /metrics/packages/{owner}/{repo}/.
 */
class CloudsmithMetricsPackagesList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_metrics_packages_list';
    protected const DESCRIPTION = 'View for listing package usage metrics, for a repository.

Official Cloudsmith endpoint: GET /metrics/packages/{owner}/{repo}/

View for listing package usage metrics, for a repository.';
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
  'packages' => array (
  'type' => 'string',
  'description' => 'A comma seperated list of packages (slug perm) to include in the results.',
),
  'start' => array (
  'type' => 'string',
  'description' => 'Include metrics from and including this UTC date or UTC datetime. For example \'2020-12-31\' or \'2021-12-13T00:00:00Z\'.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/metrics/packages/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'finish' => 'finish',
  'packages' => 'packages',
  'start' => 'start',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
