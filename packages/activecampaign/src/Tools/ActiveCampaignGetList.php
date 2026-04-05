<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single list by ID from ActiveCampaign.
 */
class ActiveCampaignGetList implements Tool
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
        return 'activecampaign_get_list';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific ActiveCampaign list by ID, including name, subscriber count, and settings.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign list ID.'],
        ];
    }

    /**
     * Execute the tool: get a list from ActiveCampaign.
     *
     * @param  array     $args The tool arguments (list_id).
     * @return ToolResult      The result containing the list or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $listId = (int) ($args['list_id'] ?? 0);
            if ($listId <= 0) {
                return ToolResult::error('A valid list_id is required.');
            }

            $result = $this->service->getList($listId);
            $list = $result['list'] ?? $result;

            return ToolResult::success([
                'id' => (int) ($list['id'] ?? 0),
                'name' => $list['name'] ?? '',
                'stringid' => $list['stringid'] ?? '',
                'subscriber_count' => (int) ($list['subscriber_count'] ?? 0),
                'created' => $list['cdate'] ?? null,
                'updated' => $list['udate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
