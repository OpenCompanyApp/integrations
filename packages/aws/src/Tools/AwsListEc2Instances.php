<?php

namespace OpenCompany\Integrations\Aws\Tools;

use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AwsListEc2Instances implements Tool
{
    /**
     * Create a new AwsListEc2Instances tool instance.
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
        return 'aws_list_ec2_instances';
    }

    /**
     * Get the human-readable description of this tool.
     *
     * @return string A description shown in tool catalogs and generated documentation.
     */
    public function description(): string
    {
        return 'Describe EC2 instances in the AWS account. Returns instance IDs, types, states, and metadata. Supports filtering by instance IDs, states, or tags.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>> The parameter schema.
     */
    public function parameters(): array
    {
        return [
            'instance_ids' => [
                'type' => 'array',
                'description' => 'List of specific instance IDs to describe (e.g., ["i-1234567890abcdef0"]). Omit to list all instances.',
                'items' => ['type' => 'string'],
            ],
            'filters' => [
                'type' => 'array',
                'description' => 'Filters to apply (e.g., [{"Name": "instance-state-name", "Values": ["running"]}]).',
            ],
            'region' => [
                'type' => 'string',
                'description' => 'AWS region to query (e.g., "us-east-1"). Defaults to the configured region.',
            ],
        ];
    }

    /**
     * Execute the tool: describe EC2 instances.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing EC2 instance descriptions or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AWS integration is not configured.');
            }

            $data = [];

            if (isset($args['instance_ids'])) {
                $data['InstanceIds'] = $args['instance_ids'];
            }

            if (isset($args['filters'])) {
                $data['Filters'] = $args['filters'];
            }

            if (isset($args['region'])) {
                $data['region'] = $args['region'];
            }

            $result = $this->service->post('/ec2/describe-instances', $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
