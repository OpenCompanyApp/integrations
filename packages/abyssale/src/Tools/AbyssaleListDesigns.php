<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Abyssale designs available in the workspace.
 */
class AbyssaleListDesigns extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_list_designs';
    }

    public function description(): string
    {
        return 'List Abyssale designs available to the API key.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list designs request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listDesigns());
    }
}
