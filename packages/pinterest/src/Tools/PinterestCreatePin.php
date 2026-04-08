<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new pin on Pinterest.
 *
 * Creates a pin on the specified board with a title, description,
 * and image sourced from a URL.
 */
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
        return 'Create a new pin on a Pinterest board. Provide the board ID, title, description, and image URL. Optionally include a destination link.';
    }

    public function parameters(): array
    {
        return [
            'boardId' => ['type' => 'string', 'required' => true, 'description' => 'The board ID to pin to.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the pin.'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'The description of the pin.'],
            'mediaSource' => ['type' => 'string', 'required' => false, 'description' => 'The media source type (default: "image_url").'],
            'imageUrl' => ['type' => 'string', 'required' => true, 'description' => 'The URL of the image to pin.'],
            'link' => ['type' => 'string', 'required' => false, 'description' => 'Optional destination link URL for the pin.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            if (empty($args['boardId'])) {
                return ToolResult::error('A board ID is required.');
            }

            if (empty($args['imageUrl'])) {
                return ToolResult::error('An image URL is required.');
            }

            $result = $this->service->createPin(
                boardId: $args['boardId'],
                title: $args['title'] ?? '',
                description: $args['description'] ?? '',
                mediaSource: $args['mediaSource'] ?? 'image_url',
                imageUrl: $args['imageUrl'],
                link: $args['link'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
