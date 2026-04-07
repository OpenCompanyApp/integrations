<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Buffer update by ID.
 *
 * Retrieves full details for a specific scheduled or sent update,
 * including text, profile targets, media, and delivery status.
 */
class BufferGetUpdate implements Tool
{
    public function __construct(
        private BufferService $service,
    ) {}

    public function name(): string
    {
        return 'buffer_get_update';
    }

    public function description(): string
    {
        return 'Get details of a specific Buffer update by its ID. Returns the update text, scheduled or sent time, social profiles, media, and delivery status.';
    }

    public function parameters(): array
    {
        return [
            'updateId' => ['type' => 'string', 'required' => true, 'description' => 'The update ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            $result = $this->service->getUpdate($args['updateId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
