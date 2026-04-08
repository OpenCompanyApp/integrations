<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list subscribers for a Beehiiv publication.
 *
 * Supports filtering by status and pagination via limit/page parameters.
 */
class BeehiivListSubscribers implements Tool
{
    /**
     * Create a new BeehiivListSubscribers tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_list_subscribers';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List subscribers for your Beehiiv publication. Filter by status (active, inactive, etc.) and paginate with limit/page.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by subscriber status: "active", "inactive", "pending". Omit to list all.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of subscribers to return per page (default: 20, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool — list subscribers from Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listSubscribers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
