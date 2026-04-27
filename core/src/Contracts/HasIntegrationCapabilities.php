<?php

namespace OpenCompany\IntegrationCore\Contracts;

/**
 * Declares host and authentication capabilities for an integration.
 *
 * Implement this optional contract when the default catalog inference is not
 * precise enough, such as browser-only OAuth setup, local redirect OAuth,
 * device-code setup, service-account auth, or CLI-only integrations.
 */
interface HasIntegrationCapabilities
{
    /**
     * Return structured capability metadata for hosts and generated catalogs.
     *
     * Expected keys:
     * - auth: strategy, setup_flows, requires_browser_for_setup, refreshable
     * - host_availability: web/cli setup and runtime support
     * - runtime_requirements: optional local binaries or services required
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array;
}
