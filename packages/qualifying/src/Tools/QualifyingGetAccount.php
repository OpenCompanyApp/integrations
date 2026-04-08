<?php

namespace OpenCompany\Integrations\Qualifying\Tools;

use OpenCompany\Integrations\Qualifying\QualifyingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QualifyingGetAccount implements Tool
{
    public function __construct(
        private QualifyingService $service,
    ) {}

    public function name(): string
    {
        return 'qualifying_get_account';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific sales account in Qualifying. Returns the account\'s full profile including name, industry, website, and associated metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the account.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qualifying integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Account ID is required.');
            }

            $result = $this->service->getAccount($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
