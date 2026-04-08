<?php

namespace OpenCompany\Integrations\Mailtrap\Tools;

use OpenCompany\Integrations\Mailtrap\MailtrapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailtrapListMessages implements Tool
{
    public function __construct(
        private MailtrapService $service,
    ) {}

    public function name(): string
    {
        return 'mailtrap_list_messages';
    }

    public function description(): string
    {
        return 'List messages in a Mailtrap inbox with optional search and pagination.';
    }

    public function parameters(): array
    {
        return [
            'inbox_id' => ['type' => 'integer', 'required' => true, 'description' => 'The inbox ID to list messages from.'],
            'page'     => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of messages per page (default: 25).'],
            'search'   => ['type' => 'string',  'description' => 'Search query to filter messages by subject, from, or to.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailtrap integration is not configured.');
            }

            $inboxId = $args['inbox_id'] ?? '';

            if (empty($inboxId)) {
                return ToolResult::error('The "inbox_id" parameter is required.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }

            $result = $this->service->listMessages($inboxId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
