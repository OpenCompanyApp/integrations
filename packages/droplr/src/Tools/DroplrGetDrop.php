<?php

namespace OpenCompany\Integrations\Droplr\Tools;

use OpenCompany\Integrations\Droplr\DroplrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DroplrGetDrop implements Tool
{
    public function __construct(
        private DroplrService $service,
    ) {}

    public function name(): string
    {
        return 'droplr_get_drop';
    }

    public function description(): string
    {
        return 'Get details of a specific drop (short link, file, image, or note) by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The drop ID (the short code, e.g., "abc123").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Droplr integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Drop ID is required.');
            }

            $result = $this->service->getDrop($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
