<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get public user data.
 *
 * Executes the official Apify API operation user_get.
 */
class ApifyUserGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_user_get';
}
