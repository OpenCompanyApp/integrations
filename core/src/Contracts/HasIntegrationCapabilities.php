<?php

namespace OpenCompany\IntegrationCore\Contracts;

/**
 * Declares host and authentication capabilities for an integration.
 *
 * Implement this optional contract when the default catalog inference is not
 * precise enough, such as browser-only OAuth setup, local redirect OAuth,
 * device-code setup, service-account auth, CLI-only integrations, runtime
 * requirements, or generated SEO/setup guidance.
 */
interface HasIntegrationCapabilities
{
    /**
     * Return structured capability metadata for hosts and generated catalogs.
     *
     * Expected keys:
     * - auth: strategy, setup_flows, requires_browser_for_setup, refreshable
     * - host_availability: web/cli/MCP gateway setup and runtime support
     * - runtime_requirements: optional local binaries or services required
     * - compatibility: cli_setup_supported, cli_runtime_supported, etc.
     * - seo: optional generated documentation summaries and search fields
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array;
}
