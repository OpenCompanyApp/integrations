<?php

namespace OpenCompany\Integrations\Mermaid;

use OpenCompany\Integrations\Mermaid\Tools\RenderMermaid;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

class MermaidToolProvider implements ToolProvider
{
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
    }

    public function credentialFields(): array
    {
        return [];
    }
}
