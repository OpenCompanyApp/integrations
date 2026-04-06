<?php

namespace OpenCompany\Integrations\Karbon\Tools;

use OpenCompany\Integrations\Karbon\KarbonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KarbonGetContact implements Tool
{
    public function __construct(
        private KarbonService $service,
    ) {}

    public function name(): string
    {
        return 'karbon_get_contact';
    }

    public function description(): string
    {
        return 'Get a single contact from Karbon by its unique identifier. Returns full contact details including name, email, phone, company, and any associated notes.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Karbon integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
