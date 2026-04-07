<?php

namespace OpenCompany\Integrations\Fauna\Tools;

use OpenCompany\Integrations\Fauna\FaunaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Fauna collection by name.
 */
class FaunaGetCollection implements Tool
{
    /**
     * @param  FaunaService  $service  The Fauna API client
     */
    public function __construct(
        private FaunaService $service,
    ) {}

    public function name(): string
    {
        return 'fauna_get_collection';
    }

    public function description(): string
    {
        return <<<'MD'
        Get details of a specific Fauna collection by name. Returns collection metadata
        including name, reference, creation time, and configured options.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
        ];
    }

    /**
     * Get a specific collection by name.
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

            $result = $this->service->getCollection($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
