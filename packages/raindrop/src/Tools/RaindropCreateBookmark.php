<?php

namespace OpenCompany\Integrations\Raindrop\Tools;

use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RaindropCreateBookmark implements Tool
{
    public function __construct(
        private RaindropService $service,
    ) {}

    public function name(): string
    {
        return 'raindrop_create_bookmark';
    }

    public function description(): string
    {
        return 'Save a new bookmark to Raindrop.io. Provide a URL and optionally set the title, tags, collection, and description.';
    }

    public function parameters(): array
    {
        return [
            'link' => ['type' => 'string', 'required' => true, 'description' => 'The URL to bookmark.'],
            'title' => ['type' => 'string', 'description' => 'Title for the bookmark. If omitted, Raindrop will auto-detect from the page.'],
            'tags' => ['type' => 'array', 'description' => 'Tags to assign to the bookmark (array of strings).'],
            'collection_id' => ['type' => 'integer', 'description' => 'Collection ID to save into. Use 0 or omit for "Unsorted".'],
            'excerpt' => ['type' => 'string', 'description' => 'A short description or note for the bookmark.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Raindrop.io integration is not configured.');
            }

            $link = $args['link'];
            $title = $args['title'] ?? null;
            $tags = $args['tags'] ?? [];
            $collectionId = isset($args['collection_id']) ? (int) $args['collection_id'] : null;
            $excerpt = $args['excerpt'] ?? null;

            $result = $this->service->createBookmark($link, $title, $tags, $collectionId, $excerpt);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
