<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get warmup analytics for email accounts.
 */
class InstantlyAnalyticsWarmup implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_analytics_warmup';
    }

    public function description(): string
    {
        return 'Get warmup analytics for email accounts.';
    }

    public function parameters(): array
    {
        return [
            'emails' => ['type' => 'array', 'required' => true, 'description' => 'Email addresses to check', 'items' => ['type' => 'string']],
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

            $emails = $args['emails']; if (is_string($emails)) $emails = array_map('trim', explode(',', $emails)); $result = $this->service->getAnalyticsWarmup($emails);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
