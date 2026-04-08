<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class EmailOctopusListContacts implements Tool
{
    public function __construct(
        private EmailOctopusService $service,
    ) {}

    public function name(): string
    {
        return 'emailoctopus_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in an EmailOctopus mailing list. Returns contact email addresses, statuses, and pagination cursors.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'description' => 'The list ID to query. Uses the default configured list if omitted.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 100, max: 100).'],
            'before' => ['type' => 'string', 'description' => 'Cursor for pagination — contact ID to paginate before.'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — contact ID to paginate after.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('EmailOctopus integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $result = $this->service->listContacts(
                listId: $args['list_id'] ?? null,
                limit: $limit,
                before: $args['before'] ?? null,
                after: $args['after'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
