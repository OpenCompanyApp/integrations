<?php

namespace OpenCompany\Integrations\Zapier\Tools;

use OpenCompany\Integrations\Zapier\ZapierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List zaps in Zapier with optional filters.
 */
class ZapierListZaps implements Tool
{
    /**
     * @param  ZapierService  $service  The Zapier API client
     */
    public function __construct(
        private ZapierService $service,
    ) {}

    public function name(): string
    {
        return 'zapier_list_zaps';
    }

    public function description(): string
    {
        return 'List zaps in Zapier with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Max number of zaps to return.'],
            'page'  => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Retrieve a list of zaps with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zapier integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $zaps = $this->service->listZaps($params);

            return ToolResult::success($zaps);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
