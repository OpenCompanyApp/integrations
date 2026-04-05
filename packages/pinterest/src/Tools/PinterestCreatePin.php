<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PinterestCreatePin implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_create_pin';
    }

    public function description(): string
    {
        return 'Create a new pin on a Pinterest board using an image URL. Pins are visual bookmarks that link back to the source.';
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'string', 'required' => true, 'description' => 'The board to pin to.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the pin.'],
            'image_url' => ['type' => 'string', 'required' => true, 'description' => 'The URL of the image to pin.'],
            'description' => ['type' => 'string', 'description' => 'An optional description for the pin.'],
            'link' => ['type' => 'string', 'description' => 'An optional destination link for the pin (e.g., a blog post URL).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            if (empty($args['board_id'])) {
                return ToolResult::error('board_id is required.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('title is required.');
            }

            if (empty($args['image_url'])) {
                return ToolResult::error('image_url is required.');
            }

            $result = $this->service->createPin(
                $args['board_id'],
                $args['title'],
                $args['image_url'],
                $args['description'] ?? null,
                $args['link'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
