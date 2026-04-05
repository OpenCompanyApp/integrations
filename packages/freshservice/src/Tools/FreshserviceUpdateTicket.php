<?php

namespace OpenCompany\Integrations\Freshservice\Tools;

use OpenCompany\Integrations\Freshservice\FreshserviceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshserviceUpdateTicket implements Tool
{
    /**
     * Create a new FreshserviceUpdateTicket tool instance.
     */
    public function __construct(
        private FreshserviceService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshservice_update_ticket';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Update an existing Freshservice ticket. You can change status, priority, assigned agent, add tags, or modify any writable field.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket display ID.'],
            'subject' => ['type' => 'string', 'description' => 'Updated ticket subject.'],
            'description' => ['type' => 'string', 'description' => 'Updated ticket description (supports HTML).'],
            'priority' => ['type' => 'integer', 'description' => 'Priority level: 1=Low, 2=Medium, 3=High, 4=Urgent.'],
            'status' => ['type' => 'integer', 'description' => 'Status: 2=Open, 3=Pending, 4=Resolved, 5=Closed.'],
            'responder_id' => ['type' => 'integer', 'description' => 'ID of the agent to assign the ticket to.'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag strings to set on the ticket.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshservice integration is not configured.');
            }

            $ticketId = (int) $args['ticket_id'];

            // Build update data from optional fields
            $data = [];
            $fields = ['subject', 'description', 'priority', 'status', 'responder_id', 'tags'];
            foreach ($fields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->updateTicket($ticketId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
