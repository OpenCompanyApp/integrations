<?php

namespace OpenCompany\Integrations\Weave\Tools;

use OpenCompany\Integrations\Weave\WeaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single message by its unique identifier.
 *
 * Returns full message details including sender, recipient, complete
 * content body, timestamps, and delivery status from the Weave platform.
 */
class WeaveGetMessage implements Tool
{
    public function __construct(
        private WeaveService $service,
    ) {}

    public function name(): string
    {
        return 'weave_get_message';
    }

    public function description(): string
    {
        return 'Retrieve a single message by ID. Returns full message content, sender, recipient, timestamps, and delivery status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique message identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weave integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Message ID is required.');
            }

            $result = $this->service->getMessage($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
