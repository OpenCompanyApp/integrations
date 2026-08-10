<?php

namespace OpenCompany\Integrations\VegaLite;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\VegaLite\Tools\RenderVegaLite;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class VegaLiteToolProvider implements ToolProvider, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'none',
            'legacy_auth_type' => 'none',
            'credential_mode' => 'none',
            'setup_flows' =>
            [
              0 => 'none',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
              0 => 'Runtime depends on local rendering binaries being installed in the host environment.',
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'none',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'none',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
            0 =>
            [
              'type' => 'binary',
              'name' => 'node',
              'description' => 'Node.js is required to render Vega-Lite charts.',
            ],
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    public function appName(): string
    {
        return 'vegalite';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Vega-Lite',
            'description' => 'Vega-Lite chart rendering',
            'icon' => 'ph:chart-bar',
            'logo' => 'ph:chart-bar',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Vega-Lite',
            'description' => 'Vega-Lite chart rendering',
            'icon' => 'ph:chart-bar',
            'logo' => 'ph:chart-bar',
            'category' => 'rendering',
            'badge' => 'verified',
            'docs_url' => 'https://vega.github.io/vega-lite/docs/',
        ];
    }
    public function tools(): array
    {
        return [
            'render_vegalite' => [
                'class' => RenderVegaLite::class,
                'type' => 'write',
                'name' => 'Render Vega-Lite',
                'description' => 'Render a Vega-Lite JSON specification (bar, line, scatter, area, heatmap, etc.) to a PNG image.',
                'icon' => 'ph:chart-bar',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/vegalite.md';
    }    public function credentialFields(): array
    {
        return [];
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $fileStorage = app()->bound(AgentFileStorage::class) ? app(AgentFileStorage::class) : null;

        return new $class(
            app(VegaLiteService::class),
            $fileStorage,
            $context['agent'] ?? null,
        );
    }
}
