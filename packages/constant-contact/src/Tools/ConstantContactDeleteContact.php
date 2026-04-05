<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a contact from Constant Contact.
 *
 * Permanently removes a contact by their contact ID.
 */
class ConstantContactDeleteContact implements Tool
{
    /**
     * Create a new ConstantContactDeleteContact tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_delete_contact';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Delete a contact from Constant Contact by their contact ID.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The Constant Contact contact ID to delete.'],
        ];
    }

    /**
     * Execute the tool: delete a contact from Constant Contact.
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

            $this->service->deleteContact($args['contact_id']);

            return ToolResult::success([
                'message' => "Contact {$args['contact_id']} has been deleted.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
