<?php

namespace OpenCompany\Integrations\Typst;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\Typst\Tools\RenderTypst;
use OpenCompany\IntegrationCore\Contracts\AgentFileStorage;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TypstToolProvider implements ToolProvider, HasIntegrationCapabilities
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
              'name' => 'typst',
              'description' => 'Typst CLI is required to render PDFs.',
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
        return 'typst';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'PDF reports, documents, invoices',
            'description' => 'Typst document rendering to PDF',
            'icon' => 'ph:file-pdf',
            'logo' => 'ph:file-pdf',
        ];
    }

    public function tools(): array
    {
        return [
            'render_typst' => [
                'class' => RenderTypst::class,
                'type' => 'write',
                'name' => 'Render Typst',
                'description' => 'Render Typst markup to a PDF document — reports, invoices, proposals, summaries, and formatted documents.',
                'icon' => 'ph:file-pdf',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/typst.md';
    }    public function credentialFields(): array
    {
        return [];
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $fileStorage = app()->bound(AgentFileStorage::class) ? app(AgentFileStorage::class) : null;

        return new $class(
            app(TypstService::class),
            $fileStorage,
            $context['agent'] ?? null,
        );
    }
}
