<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * List domains attached to the configured HIBP subscription.
 */
class HaveIBeenPwnedSubscribedDomains extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_subscribed_domains';
    protected const DESCRIPTION = 'List domains associated with the configured HIBP subscription. Requires an HIBP API key.';
    protected const METHOD = 'subscribedDomains';
}
