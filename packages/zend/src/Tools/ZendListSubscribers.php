<?php

namespace OpenCompany\Integrations\Zend\Tools;

use OpenCompany\Integrations\Zend\ZendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscribers on a Zendesk subscriber list.
 */
class ZendListSubscribers implements Tool
{
    public function __construct(
        private ZendService $service,
    ) {}

    public function name(): string
    {
        return 'zend_list_subscribers';
    }

    public function description(): string
    {
        return 'List subscribers on a Zendesk list. Returns email addresses, names, and subscription dates.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => false, 'description' => 'The subscriber list ID to filter by.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of subscribers per page (default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $listId = $args['list_id'] ?? null;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 100;

            $result = $this->service->listSubscribers($listId, $page, $pageSize);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
