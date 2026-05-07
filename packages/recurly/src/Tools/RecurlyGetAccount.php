<?php

namespace OpenCompany\Integrations\Recurly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Recurly\RecurlyService;

/**
 * Retrieve a Recurly billing account.
 *
 * Supports Recurly account UUIDs and account-code references.
 */
class RecurlyGetAccount implements Tool
{
    /**
     * Create a new RecurlyGetAccount tool instance.
     *
     * @param RecurlyService $service The Recurly API service.
     */
    public function __construct(
        private RecurlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'recurly_get_account';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific Recurly billing account by its ID or account code.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array The parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The account ID or account code (e.g., "code-123" or a UUID).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param array $args The tool arguments (id required).
     * @return ToolResult The result containing the account data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recurly integration is not configured.');
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
