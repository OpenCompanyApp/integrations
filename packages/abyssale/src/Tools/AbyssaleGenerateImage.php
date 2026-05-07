<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate a single image synchronously from a static Abyssale design.
 */
class AbyssaleGenerateImage extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_generate_image';
    }

    public function description(): string
    {
        return 'Synchronously generate a single image from a static Abyssale design.';
    }

    public function parameters(): array
    {
        return [
            'design_id' => ['type' => 'string', 'required' => true, 'description' => 'The Abyssale design UUID.'],
            'elements' => ['type' => 'object', 'required' => true, 'description' => 'Element overrides keyed by layer name.'],
            'template_format_name' => ['type' => 'string', 'description' => 'Optional format name when the design has multiple formats.'],
        ];
    }

    /**
     * Execute the synchronous image generation request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->generateImage(
            $this->requiredString($args, 'design_id', 'Design ID'),
            $this->requiredArray($args, 'elements', 'Elements'),
            $this->optionalString($args, 'template_format_name'),
        ));
    }
}
