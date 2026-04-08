<?php

namespace OpenCompany\Integrations\Keap\Tools;

use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Keap contact by its ID.
 *
 * Returns full contact details including all associated fields,
 * email addresses, phone numbers, and tags.
 */
class KeapGetContact implements Tool
{
    public function __construct(
        private KeapService $service,
    ) {}

    public function name(): string
    {
        return 'keap_get_contact';
    }

    public function description(): string
    {
        return 'Retrieve a single Keap contact by ID. Returns full contact details including email addresses, phone numbers, and tags.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Keap contact ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keap integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
