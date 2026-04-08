<?php

namespace OpenCompany\Integrations\Fauna\Tools;

use OpenCompany\Integrations\Fauna\FaunaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Fauna database by name.
 */
class FaunaGetDatabase implements Tool
{
    /**
     * @param  FaunaService  $service  The Fauna API client
     */
    public function __construct(
        private FaunaService $service,
    ) {}

    public function name(): string
    {
        return 'fauna_get_database';
    }

    public function description(): string
    {
        return <<<'MD'
        Get details of a specific Fauna database by name. Returns database metadata
        including name, reference, creation time, and configured options.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
        ];
    }

    /**
     * Get a specific database by name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fauna integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $result = $this->service->getDatabase($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
