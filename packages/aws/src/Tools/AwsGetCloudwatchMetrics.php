<?php

namespace OpenCompany\Integrations\Aws\Tools;

use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AwsGetCloudwatchMetrics implements Tool
{
    /**
     * Create a new AwsGetCloudwatchMetrics tool instance.
     *
     * @param  AwsService  $service  The AWS service instance for making API calls.
     */
    public function __construct(
        private AwsService $service,
    ) {}

    /**
     * Get the tool slug used for routing.
     *
     * @return string The unique tool name identifier.
     */
    public function name(): string
    {
        return 'aws_get_cloudwatch_metrics';
    }

    /**
     * Get the human-readable description of this tool.
     *
     * @return string A description shown in tool catalogs and generated documentation.
     */
    public function description(): string
    {
        return 'Get CloudWatch metric data for AWS resources. Supports querying metrics by namespace, metric name, dimensions, and time range with configurable statistics and periods.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>> The parameter schema.
     */
    public function parameters(): array
    {
        return [
            'namespace' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The CloudWatch namespace (e.g., "AWS/EC2", "AWS/Lambda", "AWS/DynamoDB").',
            ],
            'metric_name' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The name of the metric (e.g., "CPUUtilization", "Invocations", "ReadThrottleEvents").',
            ],
            'statistics' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Statistics to retrieve (e.g., ["Average", "Maximum", "Sum"]).',
                'items' => ['type' => 'string'],
            ],
            'start_time' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Start time for the query (ISO 8601, e.g., "2026-01-01T00:00:00Z").',
            ],
            'end_time' => [
                'type' => 'string',
                'required' => true,
                'description' => 'End time for the query (ISO 8601, e.g., "2026-01-02T00:00:00Z").',
            ],
            'period' => [
                'type' => 'integer',
                'description' => 'The granularity in seconds for the returned data points (e.g., 60, 300, 3600). Default: 300.',
            ],
            'dimensions' => [
                'type' => 'array',
                'description' => 'Dimensions to filter by (e.g., [{"Name": "InstanceId", "Value": "i-1234567890abcdef0"}]).',
            ],
            'region' => [
                'type' => 'string',
                'description' => 'AWS region to query (e.g., "us-east-1"). Defaults to the configured region.',
            ],
        ];
    }

    /**
     * Execute the tool: get CloudWatch metric data.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing CloudWatch metric data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AWS integration is not configured.');
            }

            $namespace = $args['namespace'] ?? '';
            $metricName = $args['metric_name'] ?? '';
            $statistics = $args['statistics'] ?? [];
            $startTime = $args['start_time'] ?? '';
            $endTime = $args['end_time'] ?? '';

            if (empty($namespace) || empty($metricName)) {
                return ToolResult::error('Namespace and metric_name are required.');
            }

            if (empty($statistics)) {
                return ToolResult::error('At least one statistic is required.');
            }

            if (empty($startTime) || empty($endTime)) {
                return ToolResult::error('start_time and end_time are required.');
            }

            $metricDataQueries = [
                'MetricDataQueries' => [
                    [
                        'Id' => 'm1',
                        'MetricStat' => [
                            'Metric' => array_filter([
                                'Namespace' => $namespace,
                                'MetricName' => $metricName,
                                'Dimensions' => $args['dimensions'] ?? null,
                            ]),
                            'Period' => $args['period'] ?? 300,
                            'Stat' => $statistics[0],
                        ],
                        'ReturnData' => true,
                    ],
                ],
                'StartTime' => $startTime,
                'EndTime' => $endTime,
            ];

            if (isset($args['region'])) {
                $metricDataQueries['region'] = $args['region'];
            }

            $result = $this->service->post('/cloudwatch/GetMetricData', $metricDataQueries);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
