<?php

namespace OpenCompany\Integrations\Fauna\Tools;

use OpenCompany\Integrations\Fauna\FaunaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Fauna database.
 */
class FaunaCreateDatabase implements Tool
{
    /**
     * @param  FaunaService  $service  The Fauna API client
     */
    public function __construct(
        private FaunaService $service,
    ) {}

    public function name(): string
    {
        return 'fauna_create_database';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Fauna database. Provide a database name and optional configuration.
        Requires a server or admin key. Returns the created database metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Database name.'],
            'data_col' => ['type' => 'string', 'description' => 'Region group for the database (e.g., "us-east-1").'],
            'typecheck' => ['type' => 'boolean', 'description' => 'Enable typechecking for the database.'],
        ];
    }

    /**
     * Create a new database.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, data_col, typecheck)
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

            $options = [];
            if (isset($args['data_col']) && ! empty($args['data_col'])) {
                $options['data_col'] = $args['data_col'];
            }
            if (isset($args['typecheck'])) {
                $options['typecheck'] = ($args['typecheck'] === true || $args['typecheck'] === 'true');
            }

            $result = $this->service->createDatabase($name, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
