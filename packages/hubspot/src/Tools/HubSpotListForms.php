<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List HubSpot marketing forms.
 *
 * Returns a paginated list of forms with their IDs, names, and types.
 */
class HubSpotListForms implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_list_forms';
    }

    public function description(): string
    {
        return <<<'MD'
        List HubSpot marketing forms.
        Returns form IDs, names, types, and creation timestamps.
        Supports pagination with limit and after parameters.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of forms to return (default 50).'],
            'after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * List HubSpot marketing forms with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['after'])) {
                $params['after'] = $args['after'];
            }

            $result = $this->service->listForms($params);

            $forms = array_map(function (array $form): array {
                return [
                    'id' => $form['id'] ?? '',
                    'name' => $form['name'] ?? '',
                    'type' => $form['formType'] ?? $form['type'] ?? '',
                    'created_at' => $form['createdAt'] ?? null,
                    'updated_at' => $form['updatedAt'] ?? null,
                ];
            }, $result['results'] ?? []);

            $output = ['results' => $forms];

            if (isset($result['paging']['next']['after'])) {
                $output['after'] = $result['paging']['next']['after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
