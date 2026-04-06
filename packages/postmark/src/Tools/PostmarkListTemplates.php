<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PostmarkListTemplates implements Tool
{
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_list_templates';
    }

    public function description(): string
    {
        return 'List email templates available in your Postmark server. Returns template IDs, aliases, names, and types for use with template-based sending.';
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Number of templates to return (default: 100, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $count = isset($args['count']) ? min((int) $args['count'], 500) : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listTemplates($count, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
