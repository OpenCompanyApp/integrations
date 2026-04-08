<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tally\TallyService;

/**
 * List all Tally forms with pagination support.
 */
class TallyListForms implements Tool
{
    /**
     * @param  TallyService  $service  The Tally API service instance.
     */
    public function __construct(
        private TallyService $service,
    ) {}

    public function name(): string
    {
        return 'tally_list_forms';
    }

    public function description(): string
    {
        return 'List all Tally forms accessible to the authenticated user. Returns form IDs, titles, status, and submission counts. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default: 1).',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of forms per page (default: 20, max: 100).',
            ],
        ];
    }

    /**
     * Execute the list forms request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, limit).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listForms($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
