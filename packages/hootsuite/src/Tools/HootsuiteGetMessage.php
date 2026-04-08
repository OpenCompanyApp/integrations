<?php

namespace OpenCompany\Integrations\Hootsuite\Tools;

use OpenCompany\Integrations\Hootsuite\HootsuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Hootsuite message by ID.
 *
 * Retrieves full details for a specific scheduled or past message,
 * including text, social profile targets, and delivery status.
 */
class HootsuiteGetMessage implements Tool
{
    public function __construct(
        private HootsuiteService $service,
    ) {}

    public function name(): string
    {
        return 'hootsuite_get_message';
    }

    public function description(): string
    {
        return 'Get details of a specific Hootsuite message by its ID. Returns the message text, scheduled send time, social profiles, and delivery status.';
    }

    public function parameters(): array
    {
        return [
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'The message ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hootsuite integration is not configured.');
            }

            $result = $this->service->getMessage($args['messageId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
