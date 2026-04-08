<?php

namespace OpenCompany\Integrations\Aws\Tools;

use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AwsInvokeLambda implements Tool
{
    /**
     * Create a new AwsInvokeLambda tool instance.
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
        return 'aws_invoke_lambda';
    }

    /**
     * Get the human-readable description of this tool.
     *
     * @return string A description shown in tool catalogs and generated documentation.
     */
    public function description(): string
    {
        return 'Invoke an AWS Lambda function with an optional payload. Supports synchronous (RequestResponse) and asynchronous (Event) invocation modes.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>> The parameter schema.
     */
    public function parameters(): array
    {
        return [
            'function_name' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The name or ARN of the Lambda function to invoke.',
            ],
            'payload' => [
                'type' => 'object',
                'description' => 'JSON payload to pass to the Lambda function.',
            ],
            'invocation_type' => [
                'type' => 'string',
                'enum' => ['RequestResponse', 'Event', 'DryRun'],
                'description' => 'Invocation type: "RequestResponse" (sync, default), "Event" (async), or "DryRun" (validate only).',
            ],
            'region' => [
                'type' => 'string',
                'description' => 'AWS region (e.g., "us-east-1"). Defaults to the configured region.',
            ],
        ];
    }

    /**
     * Execute the tool: invoke a Lambda function.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the Lambda invocation response or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AWS integration is not configured.');
            }

            $functionName = $args['function_name'] ?? '';
            if (empty($functionName)) {
                return ToolResult::error('Function name is required.');
            }

            $data = [];

            if (isset($args['payload'])) {
                $data['payload'] = $args['payload'];
            }

            if (isset($args['invocation_type'])) {
                $data['InvocationType'] = $args['invocation_type'];
            }

            if (isset($args['region'])) {
                $data['region'] = $args['region'];
            }

            $result = $this->service->post(
                '/lambda/functions/' . urlencode($functionName) . '/invocations',
                $data,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
