<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate a multi-page PDF asynchronously from an Abyssale design.
 */
class AbyssaleGenerateMultiPagePdf extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_generate_multi_page_pdf';
    }

    public function description(): string
    {
        return 'Asynchronously generate a multi-page PDF from an Abyssale design.';
    }

    public function parameters(): array
    {
        return [
            'design_id' => ['type' => 'string', 'required' => true, 'description' => 'The Abyssale design UUID.'],
            'pages' => ['type' => 'object', 'description' => 'Page overrides keyed by page or layer name.'],
            'callback_url' => ['type' => 'string', 'description' => 'Optional callback URL for the completed PDF payload.'],
        ];
    }

    /**
     * Execute the multi-page PDF generation request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->generateMultiPagePdf(
            $this->requiredString($args, 'design_id', 'Design ID'),
            $this->arrayArg($args, 'pages'),
            $this->optionalString($args, 'callback_url'),
        ));
    }
}
