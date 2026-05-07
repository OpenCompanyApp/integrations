<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Views for working with repository webhooks..
 *
 * Maps to the official Cloudsmith endpoint get /webhooks/{owner}/{repo}/{identifier}/.
 */
class CloudsmithWebhooksRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_webhooks_read';
    protected const DESCRIPTION = 'Views for working with repository webhooks.

Official Cloudsmith endpoint: GET /webhooks/{owner}/{repo}/{identifier}/

Views for working with repository webhooks.';
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
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/webhooks/{owner}/{repo}/{identifier}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
