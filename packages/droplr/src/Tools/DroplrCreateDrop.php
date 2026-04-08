<?php

namespace OpenCompany\Integrations\Droplr\Tools;

use OpenCompany\Integrations\Droplr\DroplrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DroplrCreateDrop implements Tool
{
    public function __construct(
        private DroplrService $service,
    ) {}

    public function name(): string
    {
        return 'droplr_create_drop';
    }

    public function description(): string
    {
        return 'Create a new drop (short link) in Droplr. Provide a long URL to shorten, with optional title and variant.';
    }

    public function parameters(): array
    {
        return [
            'link' => ['type' => 'string', 'required' => true, 'description' => 'The long URL to shorten (e.g., "https://example.com/very/long/url").'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the drop.'],
            'variant' => ['type' => 'string', 'description' => 'Optional variant type: "redirect" (default) or "frame" (embeds in a frame).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Droplr integration is not configured.');
            }

            if (empty($args['link'])) {
                return ToolResult::error('A link URL is required to create a drop.');
            }

            $result = $this->service->createDrop(
                link: $args['link'],
                title: $args['title'] ?? null,
                variant: $args['variant'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
