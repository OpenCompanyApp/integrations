<?php

namespace OpenCompany\Integrations\Ifttt\Tools;

use OpenCompany\Integrations\Ifttt\IftttService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about an IFTTT service.
 */
class IftttGetService implements Tool
{
    /**
     * @param  IftttService  $service  The IFTTT API client
     */
    public function __construct(
        private IftttService $service,
    ) {}

    public function name(): string
    {
        return 'ifttt_get_service';
    }

    public function description(): string
    {
        return 'Get detailed information about an IFTTT service.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The service ID.'],
        ];
    }

    /**
     * Retrieve a service by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('IFTTT integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $service = $this->service->getService($id);

            return ToolResult::success($service);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
