<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get device authorization URL.
 *
 * Maps to the official WorkOS endpoint post /user_management/authorize/device.
 */
class WorkOSUserlandSsoDeviceAuthorization extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_sso_device_authorization';
    protected const DESCRIPTION = 'Get device authorization URL

Official WorkOS endpoint: POST /user_management/authorize/device

Initiates the CLI Auth flow by requesting a device code and verification URLs. This endpoint implements the OAuth 2.0 Device Authorization Flow ([RFC 8628](https://datatracker.ietf.org/doc/html/rfc8628)) and is designed for command-line applications or other devices with limited input capabilities.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/authorize/device';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
