<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailgun\MailgunService;

/**
 * Add multiple members to a Mailgun mailing list in bulk.
 */
class MailgunAddMemberBulk implements Tool
{
    /** @param MailgunService $service The Mailgun API client */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_add_member_bulk';
    }

    public function description(): string
    {
        return <<<'MD'
        Add multiple members to a Mailgun mailing list in a single request. Uses upsert mode —
        existing members are updated. Each member object must contain at least an "address" key,
        and may include "name" and "vars".
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_address' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The mailing list address to add members to.',
            ],
            'members' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of member objects, each with at least an "address" key.',
                'items' => [
                    'type' => 'object',
                    'properties' => [
                        'address' => [
                            'type' => 'string',
                            'description' => 'Member email address.',
                        ],
                        'name' => [
                            'type' => 'string',
                            'description' => 'Member display name.',
                        ],
                        'vars' => [
                            'type' => 'object',
                            'description' => 'Custom variables for the member.',
                        ],
                    ],
                ],
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $listAddress = $args['list_address'] ?? '';
            if (empty($listAddress)) {
                return ToolResult::error('The "list_address" parameter is required.');
            }

            $members = $args['members'] ?? [];
            if (empty($members)) {
                return ToolResult::error('The "members" parameter is required and must not be empty.');
            }

            $result = $this->service->addMemberBulk(
                listAddress: $listAddress,
                members: $members,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
