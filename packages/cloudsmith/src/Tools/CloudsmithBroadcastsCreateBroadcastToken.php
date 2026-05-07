<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a broadcast token..
 *
 * Maps to the official Cloudsmith endpoint post /broadcasts/{org}/broadcast-token/.
 */
class CloudsmithBroadcastsCreateBroadcastToken extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_broadcasts_create_broadcast_token';
    protected const DESCRIPTION = 'Create a broadcast token.

Official Cloudsmith endpoint: POST /broadcasts/{org}/broadcast-token/

Create a broadcast token.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/broadcasts/{org}/broadcast-token/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
