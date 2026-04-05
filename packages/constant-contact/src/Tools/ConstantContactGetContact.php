<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Constant Contact contact by ID.
 *
 * Retrieves detailed information about a specific contact,
 * including their email, name, phone, and list memberships.
 */
class ConstantContactGetContact implements Tool
{
    /**
     * Create a new ConstantContactGetContact tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_get_contact';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a single Constant Contact contact by their contact ID.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The Constant Contact contact ID.'],
        ];
    }

    /**
     * Execute the tool: fetch a single contact from Constant Contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            if (empty($args['contact_id'])) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($args['contact_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
