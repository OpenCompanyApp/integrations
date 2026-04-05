<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Linear initiative to group related projects.
 */
class LinearCreateInitiative implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_create_initiative';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Linear initiative. Initiatives group related projects together.
        Requires a name. Optionally include a description.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Initiative name.'],
            'description' => ['type' => 'string', 'description' => 'Initiative description.'],
        ];
    }

    /**
     * Create a new Linear initiative.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $input = ['name' => $name];

            if (isset($args['description'])) {
                $input['description'] = $args['description'];
            }

            $result = $this->service->createInitiative($input);
            $initiative = $result['data']['initiativeCreate']['initiative'] ?? null;

            if ($initiative === null) {
                return ToolResult::error('Failed to create initiative.');
            }

            return ToolResult::success([
                'id' => $initiative['id'] ?? '',
                'name' => $initiative['name'] ?? '',
                'description' => $initiative['description'] ?? '',
                'state' => $initiative['state'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
