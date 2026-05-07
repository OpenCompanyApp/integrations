<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * List Devin organization secrets.
 *
 * Returns metadata only; secret values are not exposed by list responses.
 */
class DevinListSecrets implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_list_secrets';
    }

    public function description(): string
    {
        return 'List Devin v3 organization secrets with optional cursor pagination. Secret values are not returned.';
    }

    public function parameters(): array
    {
        return [
            'first' => ['type' => 'integer', 'description' => 'Maximum records to return.'],
            'after' => ['type' => 'string', 'description' => 'Cursor for the next page.'],
        ];
    }

    /**
     * List organization secrets.
     *
     * @param  array<string, mixed>  $args  Optional pagination arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            return ToolResult::success($this->service->listSecrets($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
