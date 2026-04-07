<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Persons.
 *
 * Lists persons (contacts) in Pipedrive with pagination support.
 *
 * @see https://developers.pipedrive.com/docs/api/v1/Persons#getPersons
 */
class PipedriveListPersons implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API service instance.
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'pipedrive_list_persons';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List persons (contacts) in Pipedrive. Returns a paginated list with name, email, phone, organization, and owner details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of persons to return (default: 25, max: 500).'],
            'start' => ['type' => 'integer', 'description' => 'Pagination start offset (0-based).'],
        ];
    }

    /**
     * Execute the list persons tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, start).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $start = isset($args['start']) ? (int) $args['start'] : 0;

            $result = $this->service->listPersons($limit, $start);

            $persons = $result['data'] ?? [];
            $more    = $result['additional_data']['pagination']['more_items_in_collection'] ?? false;

            return ToolResult::success([
                'persons'  => $persons,
                'count'    => count($persons),
                'has_more' => $more,
                'start'    => $start,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
