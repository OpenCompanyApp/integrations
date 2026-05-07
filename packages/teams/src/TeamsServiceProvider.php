<?php

namespace OpenCompany\Integrations\Teams;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsServiceProvider;

/**
 * Legacy compatibility alias for the canonical Microsoft Teams service provider.
 *
 * Hosts requiring the old package now register the canonical `microsoft-teams`
 * provider and can still use stored `teams` credentials through fallback lookup.
 */
class TeamsServiceProvider extends MicrosoftTeamsServiceProvider
{
}
