<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all blocklist entries (blocked emails and domains).
 */
class InstantlyListBlocklist implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_blocklist';
    }

    public function description(): string
    {
        return 'List all blocklist entries (blocked emails and domains).';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page (1-100)'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'domains_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Only show domains'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search by email/domain'],
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

            $params = []; foreach (['limit','starting_after','domains_only','search'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $result = $this->service->listBlocklist($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
