<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Revoke access token.
 *
 * Executes the official Box API operation post_oauth2_revoke.
 */
class BoxPostOauth2Revoke extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_oauth2_revoke';
}
