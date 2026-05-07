<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create or retrieve API token for a user..
 *
 * Maps to the official Cloudsmith endpoint post /user/token/.
 */
class CloudsmithUserTokenCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_user_token_create';
    protected const DESCRIPTION = 'Create or retrieve API token for a user.

Official Cloudsmith endpoint: POST /user/token/

Handles both:
- Users authenticating with basic credentials to get a token
- Two-factor authentication flow';
    protected const PARAMETERS = array (
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/user/token/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
