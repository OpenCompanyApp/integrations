<?php

namespace OpenCompany\Integrations\Lasso\Tools;

use OpenCompany\Integrations\Lasso\LassoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Contact.
 *
 * Retrieves a single contact (registrant) by its ID from Lasso CRM.
 */
class LassoGetContact implements Tool
{
    /**
     * @param  LassoService  $service  The Lasso API service instance.
     */
    public function __construct(
        private LassoService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'lasso_get_contact';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single contact (registrant) in Lasso CRM, including emails, phone numbers, and associated information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The contact ID.'],
        ];
    }

    /**
     * Execute the get contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the contact ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Lasso CRM integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
