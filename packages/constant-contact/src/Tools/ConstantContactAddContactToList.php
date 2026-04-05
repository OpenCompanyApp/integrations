<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add contacts to a contact list in Constant Contact.
 *
 * Adds one or more existing contacts to a specified contact list
 * by providing the list ID and an array of contact IDs.
 */
class ConstantContactAddContactToList implements Tool
{
    /**
     * Create a new ConstantContactAddContactToList tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_add_contact_to_list';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Add one or more contacts to a Constant Contact list by providing the list ID and contact IDs.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The list ID to add contacts to.'],
            'contact_ids' => ['type' => 'array', 'required' => true, 'description' => 'Array of contact IDs to add to the list.'],
        ];
    }

    /**
     * Execute the tool: add contacts to a list in Constant Contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('list_id is required.');
            }

            if (empty($args['contact_ids']) || !is_array($args['contact_ids'])) {
                return ToolResult::error('contact_ids is required and must be an array.');
            }

            $result = $this->service->addContactToList($args['list_id'], $args['contact_ids']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
