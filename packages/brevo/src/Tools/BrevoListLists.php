<?php

namespace OpenCompany\Integrations\Brevo\Tools;

use OpenCompany\Integrations\Brevo\BrevoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BrevoListLists implements Tool
{
    public function __construct(
        private BrevoService $service,
    ) {}

    public function name(): string
    {
        return 'brevo_list_lists';
    }

    public function description(): string
    {
        return 'List all contact lists in your Brevo account. Supports pagination with limit and offset.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of lists to return (default: 50, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of lists to skip for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brevo integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listLists($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
