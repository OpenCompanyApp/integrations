<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * Delete one or more contacts from SendGrid by their IDs.
 */
class SendGridDeleteContact implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_delete_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete one or more contacts from SendGrid by providing their contact IDs.
        This action is permanent and cannot be undone.
        MD;
    }

    public function parameters(): array
    {
        return [
            'ids' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of contact IDs to delete.',
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

            $ids = $args['ids'] ?? [];
            if (empty($ids)) {
                return ToolResult::error('The "ids" parameter is required and must not be empty.');
            }

            $result = $this->service->deleteContact(ids: $ids);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
