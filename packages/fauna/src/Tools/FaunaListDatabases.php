<?php

namespace OpenCompany\Integrations\Fauna\Tools;

use OpenCompany\Integrations\Fauna\FaunaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all databases in the current Fauna context.
 */
class FaunaListDatabases implements Tool
{
    /**
     * @param  FaunaService  $service  The Fauna API client
     */
    public function __construct(
        private FaunaService $service,
    ) {}

    public function name(): string
    {
        return 'fauna_list_databases';
    }

    public function description(): string
    {
        return <<<'MD'
        List all databases in the current Fauna context. Returns database names
        and their metadata including creation time and references.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all databases.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fauna integration is not configured.');
            }

            $result = $this->service->listDatabases();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
