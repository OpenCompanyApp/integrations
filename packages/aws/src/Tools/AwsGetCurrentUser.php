<?php

namespace OpenCompany\Integrations\Aws\Tools;

use OpenCompany\Integrations\Aws\AwsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AwsGetCurrentUser implements Tool
{
    /**
     * Create a new AwsGetCurrentUser tool instance.
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
        return 'aws_get_current_user';
    }

    /**
     * Get the human-readable description of this tool.
     *
     * @return string A description shown in tool catalogs and generated documentation.
     */
    public function description(): string
    {
        return 'Get the current IAM user identity. Returns user ARN, account ID, and user ID. Useful for verifying credentials and understanding which AWS account is being accessed.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>> The parameter schema (empty for this tool).
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: get the current IAM user.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     * @return ToolResult The result containing IAM user information or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AWS integration is not configured.');
            }

            $result = $this->service->get('/iam/user');

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
