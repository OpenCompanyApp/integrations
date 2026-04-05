<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LaunchDarklyGetFlag implements Tool
{
    public function __construct(
        private LaunchDarklyService $service,
    ) {}

    public function name(): string
    {
        return 'launchdarkly_get_flag';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific LaunchDarkly feature flag, including targeting rules, variations, and per-environment state.';
    }

    public function parameters(): array
    {
        return [
            'feature_flag_key' => ['type' => 'string', 'required' => true, 'description' => 'The feature flag key (e.g., "enable-new-dashboard").'],
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

            $projectKey = $args['project_key'] ?? null;
            $result = $this->service->getFlag($args['feature_flag_key'], $projectKey);

            $envStates = [];
            foreach ($result['environments'] ?? [] as $envKey => $env) {
                $envStates[$envKey] = [
                    'on' => $env['on'] ?? false,
                    'archived' => $env['archived'] ?? false,
                    'salt' => $env['salt'] ?? null,
                    'targetingEnabled' => $env['on'] ?? false,
                    'rules' => count($env['rules'] ?? []),
                    'fallthrough' => $env['fallthrough'] ?? null,
                    'offVariation' => $env['offVariation'] ?? null,
                ];
            }

            return ToolResult::success([
                'key' => $result['key'] ?? '',
                'name' => $result['name'] ?? '',
                'description' => $result['description'] ?? '',
                'kind' => $result['kind'] ?? '',
                'temporary' => $result['temporary'] ?? false,
                'created_at' => $result['_creationDate'] ?? $result['creationDate'] ?? null,
                'updated_at' => $result['_maintainer'] ?? null,
                'variations' => $result['variations'] ?? [],
                'environments' => $envStates,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
