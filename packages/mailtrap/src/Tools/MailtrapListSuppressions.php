<?php

namespace OpenCompany\Integrations\Mailtrap\Tools;

use OpenCompany\Integrations\Mailtrap\MailtrapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailtrapListSuppressions implements Tool
{
    public function __construct(
        private MailtrapService $service,
    ) {}

    public function name(): string
    {
        return 'mailtrap_list_suppressions';
    }

    public function description(): string
    {
        return 'List suppressions (blocked recipients) for a Mailtrap inbox.';
    }

    public function parameters(): array
    {
        return [
            'inbox_id' => ['type' => 'integer', 'required' => true, 'description' => 'The inbox ID.'],
            'page'     => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page.'],
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

            $result = $this->service->listSuppressions($inboxId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
