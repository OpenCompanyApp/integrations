<?php

namespace OpenCompany\Integrations\Sentry\Tools;

use OpenCompany\Integrations\Sentry\SentryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SentryListProjects implements Tool
{
    public function __construct(
        private SentryService $service,
    ) {}

    public function name(): string
    {
        return 'sentry_list_projects';
    }

    public function description(): string
    {
        return 'List all Sentry projects accessible to the authenticated user. Returns project slugs, organization slugs, and platforms for use in other Sentry tools.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Filter projects by name or slug.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sentry integration is not configured.');
            }

            $params = [];
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
