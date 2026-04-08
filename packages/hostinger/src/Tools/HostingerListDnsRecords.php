<?php

namespace OpenCompany\Integrations\Hostinger\Tools;

use OpenCompany\Integrations\Hostinger\HostingerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HostingerListDnsRecords implements Tool
{
    public function __construct(
        private HostingerService $service,
    ) {}

    public function name(): string
    {
        return 'hostinger_list_dns_records';
    }

    public function description(): string
    {
        return 'List DNS records for a specific domain in Hostinger. Returns all record types (A, AAAA, CNAME, MX, TXT, etc.).';
    }

    public function parameters(): array
    {
        return [
            'domain_id' => ['type' => 'integer', 'required' => true, 'description' => 'The domain ID to list DNS records for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hostinger integration is not configured.');
            }

            $result = $this->service->listDnsRecords((int) $args['domain_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
