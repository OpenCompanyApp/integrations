<?php

namespace OpenCompany\Integrations\Raindrop\Tools;

use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RaindropGetBookmark implements Tool
{
    public function __construct(
        private RaindropService $service,
    ) {}

    public function name(): string
    {
        return 'raindrop_get_bookmark';
    }

    public function description(): string
    {
        return 'Get full details of a single bookmark by its ID, including title, URL, tags, excerpt, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The bookmark ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Raindrop.io integration is not configured.');
            }

            $result = $this->service->getBookmark((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
