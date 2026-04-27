<?php

namespace OpenCompany\Integrations\Mermaid;

use OpenCompany\Integrations\Mermaid\Tools\RenderMermaid;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MermaidToolProvider implements ToolProvider, HasIntegrationCapabilities
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
              'name' => 'mmdc',
              'description' => 'Mermaid CLI is required to render diagrams.',
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
        return 'mermaid';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'diagrams, flowcharts, sequences',
            'description' => 'Mermaid diagram rendering',
            'icon' => 'ph:graph',
            'logo' => 'ph:graph',
        ];
    }

    public function tools(): array
    {
        return [
            'render_mermaid' => [
                'class' => RenderMermaid::class,
                'type' => 'write',
                'name' => 'Render Mermaid',
                'description' => 'Render Mermaid diagram syntax (flowcharts, sequence, ER, class, state, Gantt, and more) to a PNG image.',
                'icon' => 'ph:graph',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $fileStorage = app()->bound(AgentFileStorage::class) ? app(AgentFileStorage::class) : null;

        return new $class(
            app(MermaidService::class),
            $fileStorage,
            $context['agent'] ?? null,
        );
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/mermaid.md';
    }    public function credentialFields(): array
    {
        return [];
    }
}
