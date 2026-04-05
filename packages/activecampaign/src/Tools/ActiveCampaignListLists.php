<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all contact lists from ActiveCampaign.
 */
class ActiveCampaignListLists implements Tool
{
    /**
     * @param ActiveCampaignService $service The ActiveCampaign service instance.
     */
    public function __construct(
        private ActiveCampaignService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'activecampaign_list_lists';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List all contact lists in ActiveCampaign. Returns list IDs, names, and subscriber counts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of lists to return per page (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * Execute the tool: list lists from ActiveCampaign.
     *
     * @param  array     $args The tool arguments (limit, offset).
     * @return ToolResult      The result containing lists or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $result = $this->service->listLists(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            $lists = $result['lists'] ?? [];
            $meta = $result['meta'] ?? [];

            $response = [
                'lists' => array_map(fn(array $l) => [
                    'id' => (int) ($l['id'] ?? 0),
                    'name' => $l['name'] ?? '',
                    'stringid' => $l['stringid'] ?? '',
                    'subscriber_count' => (int) ($l['subscriber_count'] ?? 0),
                    'created' => $l['cdate'] ?? null,
                    'updated' => $l['udate'] ?? null,
                ], $lists),
                'total' => $meta['total'] ?? count($lists),
            ];

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
