<?php

namespace OpenCompany\Integrations\Courier\Tools;

use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CourierGetRecipient implements Tool
{
    public function __construct(
        private CourierService $service,
    ) {}

    public function name(): string
    {
        return 'courier_get_recipient';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Courier recipient, including contact preferences and channel profiles.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The recipient ID (e.g., "rcpt_1234567890").'],
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
                return ToolResult::error('Recipient ID is required.');
            }

            $result = $this->service->getRecipient($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
