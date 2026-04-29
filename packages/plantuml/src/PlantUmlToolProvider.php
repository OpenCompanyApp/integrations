<?php

namespace OpenCompany\Integrations\PlantUml;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\PlantUml\Tools\RenderPlantUml;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PlantUmlToolProvider implements ToolProvider, HasIntegrationCapabilities
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
              'name' => 'java',
              'description' => 'Java is required to run PlantUML.',
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
        return 'plantuml';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'PlantUML',
            'description' => 'PlantUML diagram rendering',
            'icon' => 'ph:tree-structure',
            'logo' => 'ph:tree-structure',
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
            'name' => 'PlantUML',
            'description' => 'PlantUML diagram rendering',
            'icon' => 'ph:tree-structure',
            'logo' => 'ph:tree-structure',
            'category' => 'rendering',
            'badge' => 'verified',
            'docs_url' => 'https://plantuml.com/',
        ];
    }
    public function tools(): array
    {
        return [
            'render_plantuml' => [
                'class' => RenderPlantUml::class,
                'type' => 'write',
                'name' => 'Render PlantUML',
                'description' => 'Render PlantUML diagram syntax (class, sequence, activity, component, state, use case, and more) to a PNG image.',
                'icon' => 'ph:tree-structure',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/plantuml.md';
    }    public function credentialFields(): array
    {
        return [];
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $fileStorage = app()->bound(AgentFileStorage::class) ? app(AgentFileStorage::class) : null;

        return new $class(
            app(PlantUmlService::class),
            $fileStorage,
            $context['agent'] ?? null,
        );
    }
}
