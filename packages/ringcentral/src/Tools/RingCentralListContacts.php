<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\Integrations\RingCentral\RingCentralService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list contacts from the RingCentral personal address book.
 */
class RingCentralListContacts implements Tool
{
    /**
     * Create a new RingCentralListContacts tool instance.
     *
     * @param  RingCentralService  $service  The RingCentral API service.
     */
    public function __construct(
        private RingCentralService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'ringcentral_list_contacts';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List contacts from the RingCentral personal address book. Supports filtering by name prefix and pagination. Returns contact records with names, phone numbers, and email addresses.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'startsWith' => ['type' => 'string', 'description' => 'Filter contacts whose first name, last name, or company name starts with this string.'],
            'perPage' => ['type' => 'integer', 'description' => 'Number of records per page (default: 100, max: 1000).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array  $args  The tool arguments matching parameter definitions.
     * @return ToolResult The result containing contact records or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RingCentral integration is not configured.');
            }

            $params = [];
            $keys = ['startsWith', 'perPage', 'page'];
            foreach ($keys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
