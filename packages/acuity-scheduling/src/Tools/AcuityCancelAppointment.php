<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AcuityCancelAppointment implements Tool
{
    /**
     * Create a new Cancel Appointment tool instance.
     */
    public function __construct(
        private AcuitySchedulingService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'acuity_cancel_appointment';
    }

    /**
     * A description of what the tool does, used by AI agents for tool selection.
     */
    public function description(): string
    {
        return 'Cancel an existing appointment in Acuity Scheduling. Requires the appointment ID. The appointment will be marked as cancelled and the client will be notified according to notification settings.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The appointment ID to cancel.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Acuity Scheduling integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->cancelAppointment((int) $args['id']);

            return ToolResult::success([
                'message' => "Appointment {$args['id']} has been cancelled.",
                'appointment' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
