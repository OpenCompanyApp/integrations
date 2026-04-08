<?php

namespace OpenCompany\Integrations\Fauna\Tools;

use OpenCompany\Integrations\Fauna\FaunaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all collections in the current Fauna database.
 */
class FaunaListCollections implements Tool
{
    /**
     * @param  FaunaService  $service  The Fauna API client
     */
    public function __construct(
        private FaunaService $service,
    ) {}

    public function name(): string
    {
        return 'fauna_list_collections';
    }

    public function description(): string
    {
        return <<<'MD'
        List all collections in the current Fauna database. Returns collection names
        and their metadata including references and creation time.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all collections.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fauna integration is not configured.');
            }

            $result = $this->service->listCollections();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
