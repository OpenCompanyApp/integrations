<?php

namespace OpenCompany\Integrations\DigitalOcean\Tools;

use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List DNS domains managed through the DigitalOcean account.
 */
class DigitalOceanListDomains implements Tool
{
    /**
     * @param  DigitalOceanService  $service  The DigitalOcean API client.
     */
    public function __construct(
        private DigitalOceanService $service,
    ) {}

    public function name(): string
    {
        return 'digitalocean_list_domains';
    }

    public function description(): string
    {
        return 'List all DNS domains managed in the DigitalOcean account.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of domains per page (default: 20).'],
        ];
    }

    /**
     * List account domains using optional DigitalOcean pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DigitalOcean integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : null;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : null;

            $result = $this->service->listDomains($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
