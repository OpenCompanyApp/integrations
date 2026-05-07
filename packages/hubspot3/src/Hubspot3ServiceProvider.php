<?php

namespace OpenCompany\Integrations\Hubspot3;

use OpenCompany\Integrations\HubSpot\HubSpotServiceProvider;

/**
 * Legacy compatibility alias for the canonical HubSpot service provider.
 *
 * Hosts requiring the old package now register the canonical `hubspot` provider
 * and can still use stored `hubspot3` credentials through fallback lookup.
 */
class Hubspot3ServiceProvider extends HubSpotServiceProvider
{
}
