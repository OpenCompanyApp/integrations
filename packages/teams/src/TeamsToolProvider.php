<?php

namespace OpenCompany\Integrations\Teams;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsToolProvider;

/**
 * Legacy compatibility alias for the canonical Microsoft Teams tool provider.
 *
 * The `microsoft-teams` package owns discovery metadata, Lua docs, and tools.
 */
class TeamsToolProvider extends MicrosoftTeamsToolProvider
{
}
