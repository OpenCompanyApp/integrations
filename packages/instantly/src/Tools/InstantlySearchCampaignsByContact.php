<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Find campaigns containing a specific lead email.
 */
class InstantlySearchCampaignsByContact implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_search_campaigns_by_contact';
    }

    public function description(): string
    {
        return 'Find campaigns containing a specific lead email.';
    }

    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'required' => true, 'description' => 'Lead email to search'],
            'sort_column' => ['type' => 'string', 'required' => false, 'description' => 'Sort column'],
            'sort_order' => ['type' => 'string', 'required' => false, 'description' => 'Sort order (asc/desc)'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $result = $params = []; foreach (['search','sort_column','sort_order'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $this->service->searchCampaignsByContact($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
