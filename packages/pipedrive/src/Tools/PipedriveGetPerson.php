<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Pipedrive person by ID.
 *
 * Returns the person's details including name, email, phone, and associated organization.
 */
class PipedriveGetPerson implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_get_person';
    }

    public function description(): string
    {
        return 'Retrieve a Pipedrive person by their ID. Returns the person\'s name, email, phone, and organization.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Pipedrive person ID.'],
        ];
    }

    /**
     * Retrieve a Pipedrive person by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getPerson($id);
            $person = $result['data'] ?? $result;

            return ToolResult::success($person);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
