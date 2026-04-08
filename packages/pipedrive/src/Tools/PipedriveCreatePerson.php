<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new person in Pipedrive CRM.
 *
 * Supports name, email, phone, and organization association.
 */
class PipedriveCreatePerson implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_create_person';
    }

    public function description(): string
    {
        return 'Create a new person in Pipedrive CRM. Requires at least a name. Optionally associate with an organization.';
    }

    public function parameters(): array
    {
        return [
            'name'    => ['type' => 'string', 'required' => true, 'description' => 'Full name of the person.'],
            'email'   => ['type' => 'string', 'description' => 'Email address of the person.'],
            'phone'   => ['type' => 'string', 'description' => 'Phone number of the person.'],
            'org_id'  => ['type' => 'integer', 'description' => 'ID of the organization to associate with.'],
        ];
    }

    /**
     * Create a new Pipedrive person with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, email, phone, org_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (! empty($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (! empty($args['phone'])) {
                $data['phone'] = $args['phone'];
            }
            if (! empty($args['org_id'])) {
                $data['org_id'] = (int) $args['org_id'];
            }

            $result = $this->service->createPerson($data);

            $person = $result['data'] ?? $result;

            return ToolResult::success($person);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
