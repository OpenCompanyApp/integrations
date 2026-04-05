<?php

namespace OpenCompany\Integrations\Aws\Tools;

use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AwsListLambdaFunctions implements Tool
{
    /**
     * Create a new AwsListLambdaFunctions tool instance.
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
        return 'aws_list_lambda_functions';
    }

    /**
     * Get the human-readable description of this tool.
     *
     * @return string A description shown in tool catalogs and generated documentation.
     */
    public function description(): string
    {
        return 'List all Lambda functions in the AWS account. Returns function names, runtimes, descriptions, and configuration.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>> The parameter schema.
     */
    public function parameters(): array
    {
        return [
            'max_items' => [
                'type' => 'integer',
                'description' => 'Maximum number of functions to return (default: 50).',
            ],
            'region' => [
                'type' => 'string',
                'description' => 'AWS region to query (e.g., "us-east-1"). Defaults to the configured region.',
            ],
        ];
    }

    /**
     * Execute the tool: list Lambda functions.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing Lambda function listings or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AWS integration is not configured.');
            }

            $params = [];
            if (isset($args['max_items'])) {
                $params['MaxItems'] = (int) $args['max_items'];
            }
            if (isset($args['region'])) {
                $params['region'] = $args['region'];
            }

            $result = $this->service->get('/lambda/functions', $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
