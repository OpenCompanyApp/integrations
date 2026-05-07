<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a specific webhook in a repository..
 *
 * Maps to the official Cloudsmith endpoint post /webhooks/{owner}/{repo}/.
 */
class CloudsmithWebhooksCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_webhooks_create';
    protected const DESCRIPTION = 'Create a specific webhook in a repository.

Official Cloudsmith endpoint: POST /webhooks/{owner}/{repo}/

Create a specific webhook in a repository.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/webhooks/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
