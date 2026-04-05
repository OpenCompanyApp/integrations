<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list automations from ActiveCampaign.
 */
class ActiveCampaignListAutomations implements Tool
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
        return 'activecampaign_list_automations';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List all automations in ActiveCampaign. Returns automation IDs, names, status, and trigger counts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of automations to return per page (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * Execute the tool: list automations from ActiveCampaign.
     *
     * @param  array     $args The tool arguments (limit, offset).
     * @return ToolResult      The result containing automations or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $result = $this->service->listAutomations(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            $automations = $result['automations'] ?? [];
            $meta = $result['meta'] ?? [];

            $response = [
                'automations' => array_map(fn(array $a) => [
                    'id' => (int) ($a['id'] ?? 0),
                    'name' => $a['name'] ?? '',
                    'status' => (int) ($a['status'] ?? 0) === 1 ? 'active' : 'inactive',
                    'entered' => (int) ($a['entered'] ?? 0),
                    'exited' => (int) ($a['exited'] ?? 0),
                    'created' => $a['cdate'] ?? null,
                    'updated' => $a['udate'] ?? null,
                ], $automations),
                'total' => $meta['total'] ?? count($automations),
            ];

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
