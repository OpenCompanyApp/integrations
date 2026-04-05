<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VimeoListChannels implements Tool
{
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_list_channels';
    }

    public function description(): string
    {
        return 'List public Vimeo channels. Returns paginated results with channel metadata.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of channels per page (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->listChannels($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
