<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscribers assigned to a MailerLite group.
 */
class MailerLiteListGroupSubscribers extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_group_subscribers';
    }

    public function description(): string
    {
        return 'List subscribers belonging to a group with cursor pagination and status filtering.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Group ID.'],
            'filter[status]' => ['type' => 'string', 'description' => 'Subscriber status filter.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a prior response.'],
        ];
    }

    /**
     * Execute the group subscriber listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listGroupSubscribers(
            $this->required($args, 'group_id'),
            $this->only($args, ['filter[status]', 'limit', 'cursor']),
        ));
    }
}
