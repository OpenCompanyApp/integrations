<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List custom and Google fonts available in Abyssale.
 */
class AbyssaleListFonts extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_list_fonts';
    }

    public function description(): string
    {
        return 'List custom and Google fonts available to the Abyssale workspace.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list fonts request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listFonts());
    }
}
