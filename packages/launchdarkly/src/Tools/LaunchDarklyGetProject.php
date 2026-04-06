<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LaunchDarklyGetProject implements Tool
{
    public function __construct(
        private LaunchDarklyService $service,
    ) {}

    public function name(): string
    {
        return 'launchdarkly_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific LaunchDarkly project, including its environments and settings.';
    }

    public function parameters(): array
    {
        return [
            'project_key' => ['type' => 'string', 'required' => true, 'description' => 'The project key (e.g., "default", "my-backend-project").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LaunchDarkly integration is not configured.');
            }

            if (empty($args['project_key'])) {
                return ToolResult::error('The project_key parameter is required.');
            }

            $result = $this->service->getProject($args['project_key']);

            $environments = [];
            foreach ($result['environments'] ?? [] as $envKey => $env) {
                $environments[$envKey] = [
                    'key' => $env['key'] ?? $envKey,
                    'name' => $env['name'] ?? '',
                    'color' => $env['color'] ?? '',
                    'defaultTtl' => $env['defaultTtl'] ?? null,
                    'secureMode' => $env['secureMode'] ?? false,
                    'requireComments' => $env['requireComments'] ?? false,
                    'confirmChanges' => $env['confirmChanges'] ?? false,
                    'tags' => $env['tags'] ?? [],
                ];
            }

            return ToolResult::success([
                'key' => $result['key'] ?? '',
                'name' => $result['name'] ?? '',
                'description' => $result['description'] ?? '',
                'tags' => $result['tags'] ?? [],
                'environment_count' => count($environments),
                'environments' => $environments,
                'include_inSnippet' => $result['includeInSnippet'] ?? null,
                'defaultClientSideAvailability' => $result['defaultClientSideAvailability'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
