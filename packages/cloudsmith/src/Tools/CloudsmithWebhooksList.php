<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all webhooks in a repository..
 *
 * Maps to the official Cloudsmith endpoint get /webhooks/{owner}/{repo}/.
 */
class CloudsmithWebhooksList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_webhooks_list';
    protected const DESCRIPTION = 'Get a list of all webhooks in a repository.

Official Cloudsmith endpoint: GET /webhooks/{owner}/{repo}/

Get a list of all webhooks in a repository.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/webhooks/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
