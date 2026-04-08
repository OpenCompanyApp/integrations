<?php

namespace OpenCompany\Integrations\Hunter\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Hunter\HunterService;

/**
 * List leads from Hunter.io with optional pagination.
 */
class HunterListLeads implements Tool
{
    /** @param HunterService $service The Hunter.io API client */
    public function __construct(
        private HunterService $service,
    ) {}

    public function name(): string
    {
        return 'hunter_list_leads';
    }

    public function description(): string
    {
        return <<<'MD'
        List leads stored in your Hunter.io account. Supports pagination with limit
        and offset parameters. Returns lead details including email, name, and associated lists.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of leads to return (default: 20, max: 100).',
            ],
            'offset' => [
                'type' => 'integer',
                'description' => 'Number of leads to skip for pagination.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Hunter integration is not configured.');
            }

            $result = $this->service->listLeads(
                limit: $args['limit'] ?? null,
                offset: $args['offset'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
