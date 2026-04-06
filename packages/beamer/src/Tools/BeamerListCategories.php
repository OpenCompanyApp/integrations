<?php

namespace OpenCompany\Integrations\Beamer\Tools;

use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all post categories from Beamer.
 *
 * Returns all categories configured in the Beamer account, including
 * category IDs and names. Use category IDs when creating or filtering posts.
 */
class BeamerListCategories implements Tool
{
    public function __construct(
        private BeamerService $service,
    ) {}

    public function name(): string
    {
        return 'beamer_list_categories';
    }

    public function description(): string
    {
        return 'List all post categories in your Beamer account. Returns category IDs and names for use when creating or filtering posts.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beamer integration is not configured.');
            }

            $result = $this->service->listCategories();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
