<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\Integrations\ChurnZero\ChurnZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Account.
 *
 * Retrieves a single account by its ID, including all associated details
 * such as health score, license information, and custom fields.
 *
 * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
 */
class ChurnZeroGetAccount implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero API service instance.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'churnzero_get_account';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single account in ChurnZero, including health score, license information, custom fields, and associated data.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The account ID to retrieve.'],
        ];
    }

    /**
     * Execute the get account tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the account ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Account ID is required.');
            }

            $result = $this->service->getAccount($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
