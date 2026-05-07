<?php

namespace OpenCompany\Integrations\Cal\Tools;

use OpenCompany\Integrations\Cal\CalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single event type by ID from Cal.com.
 *
 * Returns full details for a specific event type including title, duration,
 * description, scheduling constraints, and assigned user/team.
 *
 * @see https://cal.com/docs/api-reference/v2/event-types/get-an-event-type
 */
class CalGetEventType implements Tool
{
    /**
     * @param  CalService  $service  Cal.com API client.
     */
    public function __construct(
        private CalService $service,
    ) {}

    public function name(): string
    {
        return 'cal_get_event_type';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific event type from Cal.com by its ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The event type ID.'],
        ];
    }

    /**
     * Execute the tool — get a single event type from Cal.com.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cal.com integration is not configured.');
            }

            $id = (int) $args['id'];
            $result = $this->service->getEventType($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
