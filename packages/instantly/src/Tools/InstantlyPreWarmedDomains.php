<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get pre-warmed up domains available for order.
 */
class InstantlyPreWarmedDomains implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_pre_warmed_domains';
    }

    public function description(): string
    {
        return 'Get pre-warmed up domains available for order.';
    }

    public function parameters(): array
    {
        return [
            'extensions' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated extensions (com,org,co)'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search filter'],
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

            $body = []; if (isset($args['extensions'])) $body['extensions'] = array_map('trim', explode(',', $args['extensions'])); if (isset($args['search'])) $body['search'] = $args['search']; $result = $this->service->getPreWarmedDomains($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
