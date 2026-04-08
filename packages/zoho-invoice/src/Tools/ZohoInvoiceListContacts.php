<?php

namespace OpenCompany\Integrations\ZohoInvoice\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ZohoInvoice\ZohoInvoiceService;

/**
 * List contacts (customers and vendors) from Zoho Invoice.
 */
class ZohoInvoiceListContacts implements Tool
{
    /**
     * @param  ZohoInvoiceService  $service  The Zoho Invoice API service instance
     */
    public function __construct(
        private ZohoInvoiceService $service,
    ) {}

    public function name(): string
    {
        return 'zohoinvoice_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts (customers and vendors) from Zoho Invoice. Supports filtering by type (customer or vendor) and pagination.';
    }

    public function parameters(): array
    {
        return [
            'type' => [
                'type' => 'string',
                'description' => 'Filter by contact type.',
                'enum' => ['customer', 'vendor'],
            ],
            'status' => [
                'type' => 'string',
                'description' => 'Filter by status: active, inactive, draft, or archived.',
                'enum' => ['active', 'inactive', 'draft', 'archived'],
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default: 1).',
            ],
            'per_page' => [
                'type' => 'integer',
                'description' => 'Number of contacts per page (default: 25, max: 200).',
            ],
            'search_text' => [
                'type' => 'string',
                'description' => 'Search contacts by name or email.',
            ],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Invoice integration is not configured.');
            }

            $params = [];

            if (isset($args['type'])) {
                $params['type'] = $args['type'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['search_text'])) {
                $params['search_text'] = $args['search_text'];
            }

            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
