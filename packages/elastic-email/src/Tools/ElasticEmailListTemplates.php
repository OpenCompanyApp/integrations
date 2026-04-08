<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticEmailListTemplates implements Tool
{
    public function __construct(
        private ElasticEmailService $service,
    ) {}

    public function name(): string
    {
        return 'elasticemail_list_templates';
    }

    public function description(): string
    {
        return 'List email templates available in your Elastic Email account.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of templates to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Elastic Email integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listTemplates($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
