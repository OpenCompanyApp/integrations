<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list available billing plans from Chargebee.
 */
class ChargebeeListPlans implements Tool
{
    /**
     * Create a new ChargebeeListPlans tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_list_plans';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List available billing plans from Chargebee. Returns plan details including pricing, billing period, and trial settings.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of plans to return per page (max 100, default 10).'],
        ];
    }

    /**
     * Execute the list plans request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            $result = $this->service->listPlans(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
            );

            $plans = $result['list'] ?? [];

            $items = array_map(function (array $entry): array {
                return $entry['plan'] ?? $entry;
            }, $plans);

            return ToolResult::success([
                'plans' => $items,
                'count' => count($items),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
