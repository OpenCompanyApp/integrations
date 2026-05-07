<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get private user data.
 *
 * Executes the official Apify API operation users_me_get.
 */
class ApifyUsersMeGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_users_me_get';
}
