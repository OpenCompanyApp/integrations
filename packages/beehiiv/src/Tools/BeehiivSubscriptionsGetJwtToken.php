<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get subscription JWT token OAuth Scope: subscriptions:read.
 *
 * Executes the official beehiiv API operation subscriptions_get-jwt_token.
 */
class BeehiivSubscriptionsGetJwtToken extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_subscriptions_get_jwt_token';
}
