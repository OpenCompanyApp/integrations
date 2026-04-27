<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update current workspace name or logo.
 */
class InstantlyUpdateWorkspace implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_workspace';
    }

    public function description(): string
    {
        return 'Update current workspace name or logo.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => false, 'description' => 'Workspace name'],
            'org_logo_url' => ['type' => 'string', 'required' => false, 'description' => 'Logo URL'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = []; foreach (['name','org_logo_url'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->updateWorkspace($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
