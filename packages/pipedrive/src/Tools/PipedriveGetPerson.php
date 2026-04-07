<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Person.
 *
 * Retrieves a single person (contact) by their ID, including email,
 * phone, organization, and custom field values.
 *
 * @see https://developers.pipedrive.com/docs/api/v1/Persons#getPerson
 */
class PipedriveGetPerson implements Tool
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
        return 'pipedrive_get_person';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single person (contact) in Pipedrive, including email, phone, organization, and custom fields.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The person ID.'],
        ];
    }

    /**
     * Execute the get person tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the person ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Person ID is required.');
            }

            $result = $this->service->getPerson((int) $id);

            return ToolResult::success($result['data'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
