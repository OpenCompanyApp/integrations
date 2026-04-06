<?php

namespace OpenCompany\Integrations\Courier\Tools;

use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CourierGetMessage implements Tool
{
    public function __construct(
        private CourierService $service,
    ) {}

    public function name(): string
    {
        return 'courier_get_message';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Courier message, including delivery status, content, and channel details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The message ID (e.g., "msg_1234567890").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Courier integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Message ID is required.');
            }

            $result = $this->service->getMessage($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
