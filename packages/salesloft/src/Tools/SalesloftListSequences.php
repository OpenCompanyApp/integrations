<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\Integrations\Salesloft\SalesloftService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List legacy Salesloft call sequences.
 */
class SalesloftListSequences implements Tool
{
    public function __construct(
        private SalesloftService $service,
    ) {}

    public function name(): string
    {
        return 'salesloft_list_sequences';
    }

    public function description(): string
    {
        return 'List call sequences from Salesloft. Returns sequences with their IDs, names, statuses, and metadata. Supports pagination and optional status filtering.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of sequences to return per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter sequences by status (e.g., "active", "paused").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Salesloft integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listSequences($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
