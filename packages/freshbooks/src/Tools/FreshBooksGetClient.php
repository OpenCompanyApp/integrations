<?php

namespace OpenCompany\Integrations\FreshBooks\Tools;

use OpenCompany\Integrations\FreshBooks\FreshBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshBooksGetClient implements Tool
{
    public function __construct(
        private FreshBooksService $service,
    ) {}

    public function name(): string
    {
        return 'freshbooks_get_client';
    }

    public function description(): string
    {
        return 'Get details of a specific FreshBooks client by ID. Returns full client profile including contact info, company details, and outstanding balance.';
    }

    public function parameters(): array
    {
        return [
            'client_id' => ['type' => 'integer', 'required' => true, 'description' => 'The FreshBooks client ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('FreshBooks integration is not configured. Please provide an access token and account ID.');
            }

            if (empty($args['client_id'])) {
                return ToolResult::error('client_id is required.');
            }

            $result = $this->service->getClient((int) $args['client_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
