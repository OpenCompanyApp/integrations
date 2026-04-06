<?php

namespace OpenCompany\Integrations\Raindrop\Tools;

use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RaindropUpdateBookmark implements Tool
{
    public function __construct(
        private RaindropService $service,
    ) {}

    public function name(): string
    {
        return 'raindrop_update_bookmark';
    }

    public function description(): string
    {
        return 'Update an existing bookmark in Raindrop.io. Provide the bookmark ID and the fields to change (title, URL, tags, collection, description, etc.).';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The bookmark ID to update.'],
            'link' => ['type' => 'string', 'description' => 'New URL for the bookmark.'],
            'title' => ['type' => 'string', 'description' => 'New title for the bookmark.'],
            'tags' => ['type' => 'array', 'description' => 'Replace tags (array of strings).'],
            'collection_id' => ['type' => 'integer', 'description' => 'Move to a different collection by providing its ID.'],
            'excerpt' => ['type' => 'string', 'description' => 'New description or note.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Raindrop.io integration is not configured.');
            }

            $id = (int) $args['id'];
            $data = [];

            if (isset($args['link'])) {
                $data['link'] = $args['link'];
            }

            if (isset($args['title'])) {
                $data['title'] = $args['title'];
            }

            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }

            if (isset($args['collection_id'])) {
                $data['collection'] = ['$id' => (int) $args['collection_id']];
            }

            if (isset($args['excerpt'])) {
                $data['excerpt'] = $args['excerpt'];
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Provide at least one of: link, title, tags, collection_id, excerpt.');
            }

            $result = $this->service->updateBookmark($id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
