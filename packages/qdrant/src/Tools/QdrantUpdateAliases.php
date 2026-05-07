<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Atomically update Qdrant collection aliases.
 */
class QdrantUpdateAliases implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_update_aliases';
    }

    public function description(): string
    {
        return 'Atomically create, delete, or rename Qdrant collection aliases.';
    }

    public function parameters(): array
    {
        return ['actions' => ['type' => 'array', 'required' => true, 'description' => 'Alias operation actions.']];
    }

    /**
     * Update aliases atomically.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->updateAliases(['actions' => $args['actions'] ?? []]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
