<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new job in ServiceM8.
 *
 * Requires a client UUID and optional template ID and description.
 */
class ServiceM8CreateJob implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_create_job';
    }

    public function description(): string
    {
        return 'Create a new job in ServiceM8. Requires a client UUID. Optionally specify a job template and description to pre-populate the job.';
    }

    public function parameters(): array
    {
        return [
            'client_id' => ['type' => 'string', 'required' => true, 'description' => 'The UUID of the client to assign the job to.'],
            'template_id' => ['type' => 'string', 'description' => 'The UUID of a job template to apply.'],
            'description' => ['type' => 'string', 'description' => 'A description for the new job.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ServiceM8 integration is not configured.');
            }

            if (empty($args['client_id'])) {
                return ToolResult::error('Client UUID (client_id) is required to create a job.');
            }

            $data = [
                'client_uuid' => $args['client_id'],
            ];

            if (isset($args['template_id'])) {
                $data['template_uuid'] = $args['template_id'];
            }

            if (isset($args['description'])) {
                $data['job_description'] = $args['description'];
            }

            $result = $this->service->createJob($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
