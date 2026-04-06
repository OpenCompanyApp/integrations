<?php

namespace OpenCompany\Integrations\Weave\Tools;

use OpenCompany\Integrations\Weave\WeaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single appointment by its unique identifier.
 *
 * Returns full appointment details including patient information,
 * scheduled date and time, duration, provider, and current status.
 */
class WeaveGetAppointment implements Tool
{
    public function __construct(
        private WeaveService $service,
    ) {}

    public function name(): string
    {
        return 'weave_get_appointment';
    }

    public function description(): string
    {
        return 'Retrieve a single appointment by ID. Returns full details including patient info, scheduled time, duration, and status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique appointment identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weave integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Appointment ID is required.');
            }

            $result = $this->service->getAppointment($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
