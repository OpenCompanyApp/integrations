<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all email templates in Postmark.
 *
 * Supports pagination via count and offset parameters.
 */
class PostmarkListTemplates implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_list_templates';
    }

    public function description(): string
    {
        return 'List all email templates in Postmark. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'count'  => ['type' => 'integer', 'description' => 'Number of templates to return per page (default 100, max 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of templates to skip for pagination.'],
        ];
    }

    /**
     * List all email templates in Postmark.
     *
     * @param  array<string, mixed>  $args  Tool arguments (count, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $params = [];

            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listTemplates($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
