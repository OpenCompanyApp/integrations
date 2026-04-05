<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing person in Pipedrive CRM.
 *
 * Supports updating name, email, and phone fields.
 */
class PipedriveUpdatePerson implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_update_person';
    }

    public function description(): string
    {
        return 'Update an existing person in Pipedrive CRM. Provide the person ID and at least one field to update.';
    }

    public function parameters(): array
    {
        return [
            'id'    => ['type' => 'integer', 'required' => true, 'description' => 'The Pipedrive person ID.'],
            'name'  => ['type' => 'string', 'description' => 'Updated full name of the person.'],
            'email' => ['type' => 'string', 'description' => 'Updated email address.'],
            'phone' => ['type' => 'string', 'description' => 'Updated phone number.'],
        ];
    }

    /**
     * Update a Pipedrive person with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, email, phone)
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

            $data = [];

            if (array_key_exists('name', $args)) {
                $data['name'] = $args['name'];
            }
            if (array_key_exists('email', $args)) {
                $data['email'] = $args['email'];
            }
            if (array_key_exists('phone', $args)) {
                $data['phone'] = $args['phone'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required (name, email, phone).');
            }

            $result = $this->service->updatePerson($id, $data);
            $person = $result['data'] ?? $result;

            return ToolResult::success($person);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
