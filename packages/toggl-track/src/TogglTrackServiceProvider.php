<?php

namespace OpenCompany\Integrations\TogglTrack;

use OpenCompany\Integrations\Toggl\TogglServiceProvider;

/**
 * Legacy compatibility alias for the canonical Toggl service provider.
 *
 * Hosts requiring the old package now register the canonical `toggl` provider
 * and can still use stored `toggl-track` credentials through fallback lookup.
 */
class TogglTrackServiceProvider extends TogglServiceProvider
{
}
