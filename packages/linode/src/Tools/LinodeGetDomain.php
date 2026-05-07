<?php

namespace OpenCompany\Integrations\Linode\Tools;

use OpenCompany\Integrations\Linode\LinodeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Linode DNS domain by ID.
 */
class LinodeGetDomain implements Tool
{
    /**
     * @param  LinodeService  $service  The Linode API client.
     */
    public function __construct(
        private LinodeService $service,
    ) {}

    public function name(): string
    {
        return 'linode_get_domain';
    }

    public function description(): string
    {
        return 'Get details for a specific DNS domain in Linode, including SOA records, status, and zone information.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The domain ID.'],
        ];
    }

    /**
     * Fetch a domain by numeric ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Linode integration is not configured.');
            }

            $result = $this->service->getDomain((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
