<?php

namespace OpenCompany\Integrations\Copper\Tools;

use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Copper person record.
 */
class CopperUpdateContact implements Tool
{
    /**
     * @param  CopperService  $service  The Copper API client.
     */
    public function __construct(
        private CopperService $service,
    ) {}

    public function name(): string
    {
        return 'copper_update_contact';
    }

    public function description(): string
    {
        return 'Update an existing contact in Copper CRM. Only the fields provided will be updated.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Copper contact ID to update.'],
            'name' => ['type' => 'string', 'description' => 'Updated full name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Updated email address.'],
        ];
    }

    /**
     * Update a Copper person.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Copper integration is not configured.');
            }

            $id = (int) $args['id'];
            $data = [];

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['email'])) {
                $data['emails'] = [['email' => $args['email'], 'category' => 'work']];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update must be provided.');
            }

            $result = $this->service->updateContact($id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
