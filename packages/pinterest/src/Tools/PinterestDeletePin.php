<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PinterestDeletePin implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_delete_pin';
    }

    public function description(): string
    {
        return 'Delete a pin from Pinterest. This action is permanent and cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'pin_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the pin to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            if (empty($args['pin_id'])) {
                return ToolResult::error('pin_id is required.');
            }

            $this->service->deletePin($args['pin_id']);

            return ToolResult::success("Pin '{$args['pin_id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
