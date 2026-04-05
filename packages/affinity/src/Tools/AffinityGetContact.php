<?php

namespace OpenCompany\Integrations\Affinity\Tools;

use OpenCompany\Integrations\Affinity\AffinityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single contact from Affinity CRM.
 *
 * Fetches detailed information for a specific contact by its unique ID,
 * including all associated fields, email addresses, and organization links.
 */
class AffinityGetContact implements Tool
{
    /**
     * Create a new AffinityGetContact tool instance.
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
        return 'affinity_get_contact';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Get details for a specific contact in Affinity by its ID. Returns the contact\'s full profile including name, emails, phone numbers, organization, and custom fields.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Affinity contact ID.'],
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

            $id = (int) $args['id'];
            $result = $this->service->getContact($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
