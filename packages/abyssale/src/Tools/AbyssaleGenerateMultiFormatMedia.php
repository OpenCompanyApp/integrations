<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate images, videos, PDFs, GIFs, or HTML5 files asynchronously.
 */
class AbyssaleGenerateMultiFormatMedia extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_generate_multi_format_media';
    }

    public function description(): string
    {
        return 'Asynchronously generate one or more formats from an Abyssale design.';
    }

    public function parameters(): array
    {
        return [
            'design_id' => ['type' => 'string', 'required' => true, 'description' => 'The Abyssale design UUID.'],
            'elements' => ['type' => 'object', 'required' => true, 'description' => 'Element overrides keyed by layer name.'],
            'template_format_names' => ['type' => 'array', 'description' => 'Format names to generate. Omit or pass an empty array for all formats.', 'items' => ['type' => 'string']],
            'callback_url' => ['type' => 'string', 'description' => 'Optional callback URL for the completed generation payload.'],
        ];
    }

    /**
     * Execute the async media generation request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        $payload = [
            'elements' => $this->requiredArray($args, 'elements', 'Elements'),
        ];

        if (array_key_exists('template_format_names', $args)) {
            $payload['template_format_names'] = $this->arrayArg($args, 'template_format_names');
        }

        if (($callbackUrl = $this->optionalString($args, 'callback_url')) !== null) {
            $payload['callback_url'] = $callbackUrl;
        }

        return $this->run(fn (): array => $this->service->generateMultiFormatMedia(
            $this->requiredString($args, 'design_id', 'Design ID'),
            $payload,
        ));
    }
}
