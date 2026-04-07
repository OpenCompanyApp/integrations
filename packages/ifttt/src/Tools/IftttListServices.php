<?php

namespace OpenCompany\Integrations\Ifttt\Tools;

use OpenCompany\Integrations\Ifttt\IftttService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List services in IFTTT with optional filters.
 */
class IftttListServices implements Tool
{
    /**
     * @param  IftttService  $service  The IFTTT API client
     */
    public function __construct(
        private IftttService $service,
    ) {}

    public function name(): string
    {
        return 'ifttt_list_services';
    }

    public function description(): string
    {
        return 'List services in IFTTT with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Max number of services to return.'],
            'page'  => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Retrieve a list of services with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('IFTTT integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $services = $this->service->listServices($params);

            return ToolResult::success($services);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
