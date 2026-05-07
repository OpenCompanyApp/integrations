<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Vimeo album/showcase.
 */
class VimeoGetAlbum implements Tool
{
    /**
     * @param  VimeoService  $service  The Vimeo API client.
     */
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_get_album';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Vimeo album (showcase) by its ID.';
    }

    public function parameters(): array
    {
        return [
            'album_id' => ['type' => 'string', 'required' => true, 'description' => 'The album ID (e.g., "1234567").'],
        ];
    }

    /**
     * Get the album.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $albumId = (string) ($args['album_id'] ?? '');
            if ($albumId === '') {
                return ToolResult::error('album_id is required.');
            }

            $result = $this->service->getAlbum($albumId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
