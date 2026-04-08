<?php

namespace OpenCompany\Integrations\Knock\Tools;

use OpenCompany\Integrations\Knock\KnockService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KnockListRecipients implements Tool
{
    public function __construct(
        private KnockService $service,
    ) {}

    public function name(): string
    {
        return 'knock_list_recipients';
    }

    public function description(): string
    {
        return 'List notification recipients from Knock. Returns recipient identifiers and their preferences.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of recipients to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Knock integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : null;

            $result = $this->service->listRecipients($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
