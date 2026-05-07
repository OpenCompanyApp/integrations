<?php

namespace OpenCompany\Integrations\TogglTrack;

use OpenCompany\Integrations\Toggl\TogglToolProvider;

/**
 * Legacy compatibility alias for the canonical Toggl tool provider.
 *
 * The `toggl` package owns discovery metadata, Lua docs, and tools.
 */
class TogglTrackToolProvider extends TogglToolProvider
{
}
