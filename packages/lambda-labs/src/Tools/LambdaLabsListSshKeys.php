<?php

namespace OpenCompany\Integrations\LambdaLabs\Tools;

use OpenCompany\Integrations\LambdaLabs\LambdaLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LambdaLabsListSshKeys implements Tool
{
    public function __construct(
        private LambdaLabsService $service,
    ) {}

    public function name(): string
    {
        return 'lambda_labs_list_ssh_keys';
    }

    public function description(): string
    {
        return 'List all SSH keys registered in the Lambda Labs account. Returns key IDs, names, and public key fingerprints.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lambda Labs integration is not configured.');
            }

            $result = $this->service->listSshKeys();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
