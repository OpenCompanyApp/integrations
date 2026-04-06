<?php

namespace OpenCompany\Integrations\Accelo\Tools;

use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: accelo_create_ticket
 *
 * Creates a new support ticket in Accelo with a title and body,
 * optionally associated with a contract and priority level.
 */
class AcceloCreateTicket implements Tool
{
    public function __construct(
        private AcceloService $service,
    ) {}

    public function name(): string
    {
        return 'accelo_create_ticket';
    }

    public function description(): string
    {
        return 'Create a new support ticket in Accelo. Requires a title and body. Optionally associate with a contract and set priority.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The ticket title or subject.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The ticket description or body content.'],
            'contract_id' => ['type' => 'integer', 'description' => 'Optional contract ID to associate with the ticket.'],
            'priority' => ['type' => 'integer', 'description' => 'Priority level (e.g. 1–5, where 1 is highest).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Accelo integration is not configured.');
            }

            $title = $args['title'];
            $body = $args['body'];
            $contractId = isset($args['contract_id']) ? (int) $args['contract_id'] : null;
            $priority = isset($args['priority']) ? (int) $args['priority'] : null;

            $result = $this->service->createTicket($title, $body, $contractId, $priority);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
