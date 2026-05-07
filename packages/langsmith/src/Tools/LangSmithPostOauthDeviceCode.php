<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Request OAuth2 device authorization.
 *
 * Maps to the official LangSmith endpoint POST /oauth/device/code.
 */
class LangSmithPostOauthDeviceCode extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_oauth_device_code';
    protected const DESCRIPTION = 'Request OAuth2 device authorization

Official endpoint: POST /oauth/device/code
Issues a device code and user code for the device authorization flow per RFC 8628.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/oauth/device/code';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
