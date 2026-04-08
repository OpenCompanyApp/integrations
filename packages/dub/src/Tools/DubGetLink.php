<?php

namespace OpenCompany\Integrations\Dub\Tools;

use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DubGetLink implements Tool
{
    public function __construct(
        private DubService $service,
    ) {}

    public function name(): string
    {
        return 'dub_get_link';
    }

    public function description(): string
    {
        return 'Get details of a specific short link by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The link ID (e.g., "clx...", "cmo...").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dub.co integration is not configured.');
            }

            $result = $this->service->getLink($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
