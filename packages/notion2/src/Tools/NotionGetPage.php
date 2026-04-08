<?php

namespace OpenCompany\Integrations\Notion2\Tools;

use OpenCompany\Integrations\Notion2\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NotionGetPage implements Tool
{
    public function __construct(private NotionService $service) {}

    public function name(): string { return 'notion2_get_page'; }
    public function description(): string { return 'Get detailed information about a Notion page.'; }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Notion page (UUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Notion integration is not configured.'); }
            $pageId = $args['page_id'] ?? '';
            if (empty($pageId)) { return ToolResult::error('page_id is required.'); }
            $page = $this->service->getPage($pageId);
            return ToolResult::success($page);
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }
}
