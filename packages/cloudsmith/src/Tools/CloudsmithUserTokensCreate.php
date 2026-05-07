<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create an API key for the user that is currently authenticated..
 *
 * Maps to the official Cloudsmith endpoint post /user/tokens/.
 */
class CloudsmithUserTokensCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_user_tokens_create';
    protected const DESCRIPTION = 'Create an API key for the user that is currently authenticated.

Official Cloudsmith endpoint: POST /user/tokens/

Create an API key for the user that is currently authenticated.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'post';
    protected const PATH = '/user/tokens/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
