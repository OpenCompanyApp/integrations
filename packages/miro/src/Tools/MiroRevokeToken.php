<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Please use the new revoke endpoint /v2/oauth/revoke. This endpoint is considered vulnerable and deprecated due to access token passed publicly in the URL. Revoke the current access token. Revoking an access token means that the access token will no longer work. When an access token is revoked, the refresh token is also revoked and no longer valid. This does not uninstall the application for the user..
 *
 * Maps to the official Miro endpoint POST /v1/oauth/revoke.
 */
class MiroRevokeToken extends AbstractMiroTool
{
    protected const NAME = 'miro_revoke_token';
    protected const DESCRIPTION = 'Please use the new revoke endpoint /v2/oauth/revoke. This endpoint is considered vulnerable and deprecated due to access token passed publicly in the URL. Revoke the current access token. Revoking an access token means that the access token will no longer work. When an access token is revoked, the refresh token is also revoked and no longer valid. This does not uninstall the application for the user.

Official Miro endpoint: POST /v1/oauth/revoke.';
    protected const PARAMETERS = array (
      'access_token' => array (
        'type' => 'string',
        'description' => 'Access token that you want to revoke',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/oauth/revoke';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'access_token' => 'access_token',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
