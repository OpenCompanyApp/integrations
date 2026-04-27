<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a sales flow.
 */
class InstantlyCreateSalesFlow implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_sales_flow';
    }

    public function description(): string
    {
        return 'Create a sales flow.';
    }

    public function parameters(): array
    {
        return [
            'body' => ['type' => 'string', 'required' => false, 'description' => 'JSON sales flow definition'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = is_string($args['body'] ?? '') ? json_decode($args['body'], true) : ($args['body'] ?? []); $result = $this->service->createSalesFlow($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
