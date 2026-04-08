<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VimeoGetAlbum implements Tool
{
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

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $result = $this->service->getAlbum($args['album_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
