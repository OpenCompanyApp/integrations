<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Revoke the current access token. Revoking an access token means that the access token will no longer work. When an access token is revoked, the refresh token is also revoked and no longer valid. This does not uninstall the application for the user..
 *
 * Maps to the official Miro endpoint POST /v2/oauth/revoke.
 */
class MiroRevokeTokenV2 extends AbstractMiroTool
{
    protected const NAME = 'miro_revoke_token_v2';
    protected const DESCRIPTION = 'Revoke the current access token. Revoking an access token means that the access token will no longer work. When an access token is revoked, the refresh token is also revoked and no longer valid. This does not uninstall the application for the user.

Official Miro endpoint: POST /v2/oauth/revoke.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/oauth/revoke';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
