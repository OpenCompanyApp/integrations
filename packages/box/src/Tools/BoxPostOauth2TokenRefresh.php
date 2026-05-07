<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Refresh access token.
 *
 * Executes the official Box API operation post_oauth2_token#refresh.
 */
class BoxPostOauth2TokenRefresh extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_oauth2_token_refresh';
}
