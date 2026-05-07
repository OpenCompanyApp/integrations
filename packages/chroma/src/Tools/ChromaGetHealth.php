<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\Integrations\Chroma\ChromaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Check the Chroma v2 heartbeat endpoint.
 */
class ChromaGetHealth implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_get_health';
    }

    public function description(): string
    {
        return 'Check the health status of the Chroma vector database server. Returns heartbeat and version information.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the health check.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are used.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            $result = $this->service->getHealth();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
