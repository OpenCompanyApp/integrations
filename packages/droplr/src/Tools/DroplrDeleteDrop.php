<?php

namespace OpenCompany\Integrations\Droplr\Tools;

use OpenCompany\Integrations\Droplr\DroplrService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DroplrDeleteDrop implements Tool
{
    public function __construct(
        private DroplrService $service,
    ) {}

    public function name(): string
    {
        return 'droplr_delete_drop';
    }

    public function description(): string
    {
        return 'Delete a drop (short link, file, image, or note) from Droplr by its ID. This action is permanent.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The drop ID to delete (the short code, e.g., "abc123").'],
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

            $this->service->deleteDrop($args['id']);

            return ToolResult::success("Drop '{$args['id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
