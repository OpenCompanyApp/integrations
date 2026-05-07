<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Retrieve subscription status for the configured HIBP API key.
 */
class HaveIBeenPwnedSubscriptionStatus extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_subscription_status';
    protected const DESCRIPTION = 'Retrieve the HIBP subscription status for the configured API key.';
    protected const METHOD = 'subscriptionStatus';
}
