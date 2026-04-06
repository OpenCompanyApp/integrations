<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single ServiceM8 job by UUID.
 *
 * Returns full job details including all fields, line items, and metadata.
 */
class ServiceM8GetJob implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_get_job';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific ServiceM8 job by its UUID. Returns full job details including status, client, description, dates, and assigned staff.';
    }

    public function parameters(): array
    {
        return [
            'uuid' => ['type' => 'string', 'required' => true, 'description' => 'The UUID of the job to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ServiceM8 integration is not configured.');
            }

            if (empty($args['uuid'])) {
                return ToolResult::error('Job UUID is required.');
            }

            $result = $this->service->getJob($args['uuid']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
