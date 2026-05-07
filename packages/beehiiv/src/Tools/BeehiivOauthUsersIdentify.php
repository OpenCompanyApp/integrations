<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Identify user OAuth Scope: identify:read.
 *
 * Executes the official beehiiv API operation oauthUsers_identify.
 */
class BeehiivOauthUsersIdentify extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_oauth_users_identify';
}
