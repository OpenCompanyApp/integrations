<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Check domain availability for DFY orders.
 */
class InstantlyCheckDfyDomains implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_check_dfy_domains';
    }

    public function description(): string
    {
        return 'Check domain availability for DFY orders.';
    }

    public function parameters(): array
    {
        return [
            'domains' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated domains to check'],
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

            $domains = $args['domains']; if (is_string($domains)) $domains = array_map('trim', explode(',', $domains)); $result = $this->service->checkDfyDomains($domains);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
