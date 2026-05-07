<?php

namespace OpenCompany\Integrations\Accelo\Tools;

use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get an Accelo issue, also known as a ticket.
 *
 * Retrieves a single support issue by its ID from Accelo.
 */
class AcceloGetTicket implements Tool
{
    /**
     * @param  AcceloService  $service  The Accelo API client.
     */
    public function __construct(
        private AcceloService $service,
    ) {}

    public function name(): string
    {
        return 'accelo_get_ticket';
    }

    public function description(): string
    {
        return 'Get details of a specific support issue, also known as a ticket, in Accelo by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Accelo ticket ID.'],
        ];
    }

    /**
     * Get an Accelo issue.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Accelo integration is not configured.');
            }

            $ticketId = (int) $args['id'];
            $result = $this->service->getTicket($ticketId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
