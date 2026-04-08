<?php

namespace OpenCompany\Integrations\Aws\Tools;

use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AwsListDynamodbTables implements Tool
{
    /**
     * Create a new AwsListDynamodbTables tool instance.
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
        return 'aws_list_dynamodb_tables';
    }

    /**
     * Get the human-readable description of this tool.
     *
     * @return string A description shown in tool catalogs and generated documentation.
     */
    public function description(): string
    {
        return 'List all DynamoDB tables in the AWS account. Returns table names and can be used with pagination to enumerate all tables.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>> The parameter schema.
     */
    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of table names to return (default: 100).',
            ],
            'exclusive_start_table_name' => [
                'type' => 'string',
                'description' => 'The first table name that this operation will evaluate. Use for pagination.',
            ],
            'region' => [
                'type' => 'string',
                'description' => 'AWS region to query (e.g., "us-east-1"). Defaults to the configured region.',
            ],
        ];
    }

    /**
     * Execute the tool: list DynamoDB tables.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing DynamoDB table names or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AWS integration is not configured.');
            }

            $data = [];

            if (isset($args['limit'])) {
                $data['Limit'] = (int) $args['limit'];
            }

            if (isset($args['exclusive_start_table_name'])) {
                $data['ExclusiveStartTableName'] = $args['exclusive_start_table_name'];
            }

            if (isset($args['region'])) {
                $data['region'] = $args['region'];
            }

            $result = $this->service->post('/dynamodb/ListTables', $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
