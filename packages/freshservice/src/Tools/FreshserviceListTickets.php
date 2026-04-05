<?php

namespace OpenCompany\Integrations\Freshservice\Tools;

use OpenCompany\Integrations\Freshservice\FreshserviceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshserviceListTickets implements Tool
{
    /**
     * Create a new FreshserviceListTickets tool instance.
     */
    public function __construct(
        private FreshserviceService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshservice_list_tickets';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List support tickets from Freshservice. Supports pagination and predefined filters (e.g., new_and_my_open, watching, spam, deleted). Returns ticket summaries including subject, status, priority, and requester.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of tickets per page (max 100).'],
            'filter' => ['type' => 'string', 'description' => 'Predefined filter: "new_and_my_open", "watching", "spam", or "deleted".'],
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

            $result = $this->service->listTickets(
                page: isset($args['page']) ? (int) $args['page'] : null,
                perPage: isset($args['per_page']) ? (int) $args['per_page'] : null,
                filter: $args['filter'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
