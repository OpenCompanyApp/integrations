<?php

namespace OpenCompany\Integrations\Autopilot\Tools;

use OpenCompany\Integrations\Autopilot\AutopilotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific contact by ID or email.
 */
class AutopilotGetContact implements Tool
{
    public function __construct(
        private AutopilotService $service,
    ) {}

    public function name(): string
    {
        return 'autopilot_get_contact';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Autopilot contact by ID or email address.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The contact ID or email address.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Autopilot integration is not configured.');
            }

            if (empty($args['contact_id'])) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($args['contact_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
