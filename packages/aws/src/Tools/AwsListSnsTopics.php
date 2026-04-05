<?php

namespace OpenCompany\Integrations\Aws\Tools;

use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AwsListSnsTopics implements Tool
{
    /**
     * Create a new AwsListSnsTopics tool instance.
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
        return 'aws_list_sns_topics';
    }

    /**
     * Get the human-readable description of this tool.
     *
     * @return string A description shown in tool catalogs and generated documentation.
     */
    public function description(): string
    {
        return 'List all SNS notification topics in the AWS account. Returns topic ARNs and names.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>> The parameter schema.
     */
    public function parameters(): array
    {
        return [
            'next_token' => [
                'type' => 'string',
                'description' => 'Pagination token from a previous response to get the next page of results.',
            ],
            'region' => [
                'type' => 'string',
                'description' => 'AWS region to query (e.g., "us-east-1"). Defaults to the configured region.',
            ],
        ];
    }

    /**
     * Execute the tool: list SNS topics.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing SNS topic listings or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AWS integration is not configured.');
            }

            $params = [];
            if (isset($args['next_token'])) {
                $params['NextToken'] = $args['next_token'];
            }
            if (isset($args['region'])) {
                $params['region'] = $args['region'];
            }

            $result = $this->service->get('/sns/topics', $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
