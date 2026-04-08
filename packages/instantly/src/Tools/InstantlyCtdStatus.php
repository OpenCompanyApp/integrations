<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get custom tracking domain (CTD) status. Check SSL and CNAME configuration.
 */
class InstantlyCtdStatus implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_ctd_status';
    }

    public function description(): string
    {
        return 'Get custom tracking domain (CTD) status. Check SSL and CNAME configuration.';
    }

    public function parameters(): array
    {
        return [
            'host' => ['type' => 'string', 'required' => true, 'description' => 'Tracking domain host'],
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

            $result = $this->service->getCtdStatus($args['host']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
