<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Disable warmup for email accounts.
 */
class InstantlyWarmupDisable implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_warmup_disable';
    }

    public function description(): string
    {
        return 'Disable warmup for email accounts.';
    }

    public function parameters(): array
    {
        return [
            'account_ids' => ['type' => 'array', 'required' => true, 'description' => 'Account IDs to disable warmup for', 'items' => ['type' => 'string']],
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

            $result = $ids = $args['account_ids']; if (is_string($ids)) $ids = array_map('trim', explode(',', $ids)); $this->service->disableWarmup($ids);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
