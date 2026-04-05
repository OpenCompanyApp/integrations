<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LaunchDarklyToggleFlag implements Tool
{
    public function __construct(
        private LaunchDarklyService $service,
    ) {}

    public function name(): string
    {
        return 'launchdarkly_toggle_flag';
    }

    public function description(): string
    {
        return 'Turn a LaunchDarkly feature flag on or off in a specific environment. Use this to enable or disable a feature flag.';
    }

    public function parameters(): array
    {
        return [
            'feature_flag_key' => ['type' => 'string', 'required' => true, 'description' => 'The feature flag key (e.g., "enable-new-dashboard").'],
            'enabled' => ['type' => 'boolean', 'required' => true, 'description' => 'Set to true to turn the flag on, false to turn it off.'],
            'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'The environment key (e.g., "production", "staging", "development").'],
            'project_key' => ['type' => 'string', 'description' => 'The project key (defaults to the configured project).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LaunchDarkly integration is not configured.');
            }

            if (empty($args['feature_flag_key'])) {
                return ToolResult::error('The feature_flag_key parameter is required.');
            }

            if (!isset($args['enabled'])) {
                return ToolResult::error('The enabled parameter is required (true or false).');
            }

            if (empty($args['environment_key'])) {
                return ToolResult::error('The environment_key parameter is required.');
            }

            $projectKey = $args['project_key'] ?? null;
            $enabled = (bool) $args['enabled'];
            $result = $this->service->toggleFlag(
                $args['feature_flag_key'],
                $enabled,
                $args['environment_key'],
                $projectKey,
            );

            $state = $enabled ? 'ON' : 'OFF';

            return ToolResult::success([
                'key' => $result['key'] ?? $args['feature_flag_key'],
                'environment' => $args['environment_key'],
                'state' => $state,
                'message' => "Flag '{$args['feature_flag_key']}' has been turned {$state} in '{$args['environment_key']}'.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
