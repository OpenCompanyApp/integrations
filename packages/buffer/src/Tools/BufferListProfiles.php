<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all social media profiles connected to Buffer.
 *
 * Returns all social media accounts linked to the authenticated
 * user's Buffer account (e.g., Twitter, Facebook, LinkedIn, Instagram).
 */
class BufferListProfiles implements Tool
{
    public function __construct(
        private BufferService $service,
    ) {}

    public function name(): string
    {
        return 'buffer_list_profiles';
    }

    public function description(): string
    {
        return 'List all social media profiles connected to the Buffer account. Returns profile IDs, service types (e.g., Twitter, Facebook, LinkedIn), and display names.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            $result = $this->service->listProfiles();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
