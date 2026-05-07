<?php

namespace OpenCompany\Integrations\Etsy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Etsy\EtsyService;

/**
 * List all listings in the Etsy shop with optional filtering and pagination.
 */
class EtsyListListings implements Tool
{
    /**
     * @param  EtsyService  $service  The Etsy Open API client.
     */
    public function __construct(
        private EtsyService $service,
    ) {}

    public function name(): string
    {
        return 'etsy_list_listings';
    }

    public function description(): string
    {
        return 'List all listings in the Etsy shop. Returns paginated results with optional state filtering (active, draft, inactive, expired).';
    }

    public function parameters(): array
    {
        return [
            'state' => [
                'type' => 'string',
                'enum' => ['active', 'draft', 'inactive', 'expired', 'removed', 'sold_out', 'edit', 'unreviewed', 'flagged'],
                'description' => 'Filter listings by state. Defaults to "active" if not provided.',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of listings to return per page (1-100, default: 25).',
            ],
            'offset' => [
                'type' => 'integer',
                'description' => 'Offset for pagination - pass the offset from a previous response to get the next page.',
            ],
        ];
    }

    /**
     * List shop listings with optional state and pagination filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Etsy integration is not configured.');
            }

            $params = [];
            if (isset($args['state'])) {
                $params['state'] = $args['state'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listListings($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
