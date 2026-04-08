<?php

namespace OpenCompany\Integrations\GetResponse\Tools;

use OpenCompany\Integrations\GetResponse\GetResponseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetResponseUpdateContact implements Tool
{
    public function __construct(
        private GetResponseService $service,
    ) {}

    public function name(): string
    {
        return 'getresponse_update_contact';
    }

    public function description(): string
    {
        return 'Update an existing contact\'s details in GetResponse. Provide the contact ID and the fields to update.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique contact identifier.'],
            'name' => ['type' => 'string', 'description' => 'The new name for the contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GetResponse integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->updateContact(
                id: $args['id'],
                name: $args['name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
