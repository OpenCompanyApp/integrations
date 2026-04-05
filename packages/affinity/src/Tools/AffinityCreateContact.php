<?php

namespace OpenCompany\Integrations\Affinity\Tools;

use OpenCompany\Integrations\Affinity\AffinityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new contact in Affinity CRM.
 *
 * Creates a contact with the provided first name, last name, and optional
 * email addresses. The contact will appear in the Affinity workspace.
 */
class AffinityCreateContact implements Tool
{
    /**
     * Create a new AffinityCreateContact tool instance.
     *
     * @param  AffinityService  $service  The Affinity API service.
     */
    public function __construct(
        private AffinityService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'affinity_create_contact';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Create a new contact in Affinity CRM. Provide at least a first name or last name. Optionally include email addresses.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'The contact\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The contact\'s last name.'],
            'emails' => ['type' => 'array', 'description' => 'List of email addresses for the contact, e.g. ["john@example.com"].'],
            'organization_ids' => ['type' => 'array', 'description' => 'List of Affinity organization IDs to link this contact to.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Affinity integration is not configured.');
            }

            $data = [];

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }

            if (empty($data['first_name']) && empty($data['last_name'])) {
                return ToolResult::error('At least a first name or last name is required to create a contact.');
            }

            if (isset($args['emails']) && is_array($args['emails'])) {
                $data['emails'] = array_map(fn (string $email) => ['email' => $email], $args['emails']);
            }

            if (isset($args['organization_ids']) && is_array($args['organization_ids'])) {
                $data['organization_ids'] = array_map(fn ($id) => (int) $id, $args['organization_ids']);
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
