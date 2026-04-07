<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

use OpenCompany\Integrations\CockroachDb\CockroachDbService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CockroachDbCreateCluster implements Tool
{
    public function __construct(
        private CockroachDbService $service,
    ) {}

    public function name(): string
    {
        return 'cockroachdb_create_cluster';
    }

    public function description(): string
    {
        return 'Create a new CockroachDB cluster. Requires a name, cloud provider, and region configuration.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The cluster name (e.g., "my-app-prod").'],
            'cloud_provider' => ['type' => 'string', 'required' => true, 'description' => 'Cloud provider: "GCP", "AWS", or "AZURE".'],
            'region' => ['type' => 'string', 'required' => true, 'description' => 'Region where the cluster will be deployed (e.g., "us-east-1", "europe-west1").'],
            'plan' => ['type' => 'string', 'description' => 'Plan type: "SERVERLESS" or "DEDICATED" (default: "SERVERLESS").'],
            'spend_limit' => ['type' => 'integer', 'description' => 'Monthly spend limit in cents for serverless clusters.'],
            'cluster_version' => ['type' => 'string', 'description' => 'CockroachDB version (e.g., "v23.2").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CockroachDB integration is not configured.');
            }

            $params = [
                'name' => $args['name'],
                'cloud_provider' => $args['cloud_provider'],
                'config' => [
                    'regions' => [
                        [
                            'name' => $args['region'],
                        ],
                    ],
                ],
            ];

            $plan = $args['plan'] ?? 'SERVERLESS';
            $params['config']['serverless'] = [];

            if (isset($args['spend_limit'])) {
                $params['config']['serverless']['spend_limit'] = (int) $args['spend_limit'];
            }

            if ($plan === 'DEDICATED') {
                unset($params['config']['serverless']);
                $params['config']['dedicated'] = [];
            }

            if (isset($args['cluster_version'])) {
                $params['cluster_version'] = $args['cluster_version'];
            }

            $result = $this->service->createCluster($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
