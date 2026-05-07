<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a specific webhook in a repository..
 *
 * Maps to the official Cloudsmith endpoint patch /webhooks/{owner}/{repo}/{identifier}/.
 */
class CloudsmithWebhooksPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_webhooks_partial_update';
    protected const DESCRIPTION = 'Update a specific webhook in a repository.

Official Cloudsmith endpoint: PATCH /webhooks/{owner}/{repo}/{identifier}/

Update a specific webhook in a repository.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'patch';
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
