<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendgrid\SendgridService;

/**
 * Remove one or more contacts from a SendGrid marketing list.
 */
class SendGridRemoveContactFromList implements Tool
{
    /** @param SendgridService $service The SendGrid API client */
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_remove_contact_from_list';
    }

    public function description(): string
    {
        return <<<'MD'
        Remove one or more contacts from a SendGrid marketing list.
        Provide the list ID and an array of contact IDs to remove.
        The contacts are removed from the list but not deleted from SendGrid.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The marketing list ID.',
            ],
            'contact_ids' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of contact IDs to remove from the list.',
                'items' => ['type' => 'string'],
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            $contactIds = $args['contact_ids'] ?? [];
            if (empty($contactIds)) {
                return ToolResult::error('The "contact_ids" parameter is required and must not be empty.');
            }

            $result = $this->service->removeContactFromList(
                listId: $listId,
                contactIds: $contactIds,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
