<?php

namespace OpenCompany\Integrations\Twitter;

use OpenCompany\Integrations\X\XServiceProvider;

/**
 * Legacy compatibility alias for the canonical Twitter / X service provider.
 *
 * Hosts requiring the old package now register the canonical `x` provider and
 * can still use stored `twitter` credentials through fallback lookup.
 */
class TwitterServiceProvider extends XServiceProvider
{
}
