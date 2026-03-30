<?php

namespace OpenCompany\Integrations\PlantUml;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\PlantUml\Tools\RenderPlantUml;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

class PlantUmlToolProvider implements ToolProvider
{
    public function appName(): string
    {
        return 'plantuml';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'UML, class, sequence, activity diagrams',
            'description' => 'PlantUML diagram rendering',
            'icon' => 'ph:tree-structure',
            'logo' => 'ph:tree-structure',
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
        return null;
    }

    public function credentialFields(): array
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
