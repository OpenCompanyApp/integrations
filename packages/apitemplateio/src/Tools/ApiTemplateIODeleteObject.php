<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

/**
 * Delete a generated APITemplate.io object.
 *
 * Removes the generated PDF or image from the CDN and marks the transaction as deleted.
 */
class ApiTemplateIODeleteObject implements Tool
{
    /**
     * @param  ApiTemplateIOService  $service  The APITemplate.io API client
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    public function name(): string
    {
        return 'apitemplateio_delete_object';
    }

    public function description(): string
    {
        return 'Delete a generated PDF or image by transaction reference.';
    }

    public function parameters(): array
    {
        return [
            'transaction_ref' => ['type' => 'string', 'required' => true, 'description' => 'Generated object transaction reference to delete.'],
        ];
    }

    /**
     * Delete a generated object.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $transactionRef = (string) ($args['transaction_ref'] ?? '');
            if ($transactionRef === '') {
                return ToolResult::error('The "transaction_ref" parameter is required.');
            }

            return ToolResult::success($this->service->deleteObject($transactionRef));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
