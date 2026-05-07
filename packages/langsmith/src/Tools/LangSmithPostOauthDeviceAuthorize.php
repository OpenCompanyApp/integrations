<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Authorize a device code.
 *
 * Maps to the official LangSmith endpoint POST /oauth/device/authorize.
 */
class LangSmithPostOauthDeviceAuthorize extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_oauth_device_authorize';
    protected const DESCRIPTION = 'Authorize a device code

Official endpoint: POST /oauth/device/authorize
Marks a device code as authorized for the authenticated user. Called by the /activate page when the user enters their user code. Requires authentication.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/oauth/device/authorize';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
