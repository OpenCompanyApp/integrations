<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Download block list entries as CSV.
 */
class InstantlyDownloadBlocklistEntries implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_download_blocklist_entries';
    }

    public function description(): string
    {
        return 'Download block list entries as CSV text.';
    }

    public function parameters(): array
    {
        return [
            'domains_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Only include domain blocklist entries'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Only include entries matching this value'],
        ];
    }

    /**
     * Download block list entries as CSV.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $params = [];
            foreach (['domains_only', 'search'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->downloadBlocklistEntries($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
