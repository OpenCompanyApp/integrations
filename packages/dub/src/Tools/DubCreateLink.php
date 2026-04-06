<?php

namespace OpenCompany\Integrations\Dub\Tools;

use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DubCreateLink implements Tool
{
    public function __construct(
        private DubService $service,
    ) {}

    public function name(): string
    {
        return 'dub_create_link';
    }

    public function description(): string
    {
        return 'Create a new short link in Dub.co. Provide a destination URL and optionally a custom domain, key (back-half), title, description, and tags.';
    }

    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The destination URL to shorten (e.g., "https://example.com/long-page").'],
            'domain' => ['type' => 'string', 'description' => 'The domain for the short link (e.g., "dub.sh", "lnkd.in"). Defaults to workspace default.'],
            'key' => ['type' => 'string', 'description' => 'The custom key (back-half) for the short link (e.g., "my-link" → "dub.sh/my-link").'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the link.'],
            'description' => ['type' => 'string', 'description' => 'Optional description for the link.'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag names to assign to the link (e.g., ["campaign", "social"]).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dub.co integration is not configured.');
            }

            $result = $this->service->createLink(
                url: $args['url'],
                domain: $args['domain'] ?? null,
                key: $args['key'] ?? null,
                title: $args['title'] ?? null,
                description: $args['description'] ?? null,
                tags: $args['tags'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
