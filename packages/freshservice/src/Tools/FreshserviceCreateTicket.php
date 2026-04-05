<?php

namespace OpenCompany\Integrations\Freshservice\Tools;

use OpenCompany\Integrations\Freshservice\FreshserviceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshserviceCreateTicket implements Tool
{
    /**
     * Create a new FreshserviceCreateTicket tool instance.
     */
    public function __construct(
        private FreshserviceService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshservice_create_ticket';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new support ticket in Freshservice. Requires a subject and description. Optionally specify the requester email and priority (1=Low, 2=Medium, 3=High, 4=Urgent).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The ticket subject / title.'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'The ticket description (supports HTML).'],
            'email' => ['type' => 'string', 'description' => 'Email address of the requester.'],
            'priority' => ['type' => 'integer', 'description' => 'Priority level: 1=Low, 2=Medium, 3=High, 4=Urgent.'],
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

            $result = $this->service->createTicket(
                subject: $args['subject'],
                description: $args['description'],
                email: $args['email'] ?? null,
                priority: isset($args['priority']) ? (int) $args['priority'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
