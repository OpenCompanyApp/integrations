<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Campaigns
 *
 * Lists email campaigns from Constant Contact with cursor-based pagination.
 */
class ConstantContactListCampaigns implements Tool
{
    /**
     * @param  ConstantContactService  $service  The Constant Contact API service.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * The unique tool slug.
     */
    public function name(): string
    {
        return 'constantcontact_list_campaigns';
    }

    /**
     * Human-readable description shown in tool catalogs and generated docs.
     */
    public function description(): string
    {
        return 'List email campaigns from Constant Contact. Supports cursor-based pagination.';
    }

    /**
     * Parameter definitions for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of campaigns to return per page (default: 50).',
            ],
            'cursor' => [
                'type' => 'string',
                'description' => 'Pagination cursor from a previous response to fetch the next page of results.',
            ],
        ];
    }

    /**
     * Execute the list campaigns tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, cursor).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $result = $this->service->listCampaigns(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                cursor: $args['cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
