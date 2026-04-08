<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific flow (page) by its ID.
 *
 * Retrieves the full configuration and content of a single ManyChat flow,
 * including nodes, connections, and messaging content.
 */
class ManyChatGetFlow implements Tool
{
    public function __construct(
        private ManyChatService $service,
    ) {}

    public function name(): string
    {
        return 'manychat_get_flow';
    }

    public function description(): string
    {
        return 'Get details of a specific ManyChat flow (page) by ID. Returns the full flow configuration including nodes and content.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The flow (page) ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ManyChat integration is not configured.');
            }

            if (empty($args['page_id'])) {
                return ToolResult::error('page_id is required.');
            }

            $result = $this->service->getFlow($args['page_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
