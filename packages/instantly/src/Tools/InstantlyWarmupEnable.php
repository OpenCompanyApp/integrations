<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Enable warmup for email accounts. Gradually increases sending volume to build reputation.
 */
class InstantlyWarmupEnable implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_warmup_enable';
    }

    public function description(): string
    {
        return 'Enable warmup for email accounts. Gradually increases sending volume to build reputation.';
    }

    public function parameters(): array
    {
        return [
            'account_ids' => ['type' => 'array', 'required' => true, 'description' => 'Account IDs to enable warmup for', 'items' => ['type' => 'string']],
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

            $ids = $args['account_ids']; if (is_string($ids)) $ids = array_map('trim', explode(',', $ids)); $result = $this->service->enableWarmup($ids);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
