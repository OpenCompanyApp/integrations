<?php

namespace OpenCompany\Integrations\Taxjar\Tools;

use OpenCompany\Integrations\Taxjar\TaxjarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list tax categories from TaxJar.
 *
 * Returns all available product tax categories with their names,
 * product tax codes, and descriptions.
 */
class TaxjarListCategories implements Tool
{
    /**
     * Create a new TaxjarListCategories tool instance.
     *
     * @param  TaxjarService  $service  The TaxJar API service.
     */
    public function __construct(
        private TaxjarService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'taxjar_list_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List all tax categories available in TaxJar. Returns category details including name, product tax code, and description.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list categories request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TaxJar integration is not configured.');
            }

            $result = $this->service->listCategories();

            $categories = $result['categories'] ?? [];

            return ToolResult::success([
                'categories' => $categories,
                'count' => count($categories),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
