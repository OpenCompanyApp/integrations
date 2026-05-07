<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Request access token.
 *
 * Executes the official Box API operation post_oauth2_token.
 */
class BoxPostOauth2Token extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_oauth2_token';
}
