<?php

namespace OpenCompany\Integrations\NewRelic\Tools;

use OpenCompany\Integrations\NewRelic\NewRelicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NewRelicCreateDeployment implements Tool
{
    public function __construct(
        private NewRelicService $service,
    ) {}

    public function name(): string
    {
        return 'newrelic_create_deployment';
    }

    public function description(): string
    {
        return 'Record a new deployment marker in New Relic for a given application. This helps correlate deploys with performance changes.';
    }

    public function parameters(): array
    {
        return [
            'application_guid' => ['type' => 'string', 'required' => true, 'description' => 'The entity GUID of the New Relic application.'],
            'revision' => ['type' => 'string', 'required' => true, 'description' => 'The deployment revision (e.g. commit SHA, version number).'],
            'description' => ['type' => 'string', 'description' => 'A description of the deployment.'],
            'user' => ['type' => 'string', 'description' => 'The user who triggered the deployment.'],
            'changelog' => ['type' => 'string', 'description' => 'Changelog or commit message for the deployment.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('New Relic integration is not configured.');
            }

            if (empty($args['application_guid'])) {
                return ToolResult::error('The application_guid parameter is required.');
            }

            if (empty($args['revision'])) {
                return ToolResult::error('The revision parameter is required.');
            }

            $result = $this->service->createDeployment(
                applicationGuid: $args['application_guid'],
                revision: $args['revision'],
                description: $args['description'] ?? '',
                user: $args['user'] ?? '',
                changelog: $args['changelog'] ?? '',
            );

            if (!empty($result['errors'])) {
                $messages = array_map(fn ($e) => $e['description'] ?? json_encode($e), $result['errors']);
                return ToolResult::error('Deployment creation failed: ' . implode('; ', $messages));
            }

            return ToolResult::success($result['deploymentMarker'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
