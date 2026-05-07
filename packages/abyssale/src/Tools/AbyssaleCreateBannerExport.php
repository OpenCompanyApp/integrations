<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an asynchronous ZIP export for generated Abyssale files.
 */
class AbyssaleCreateBannerExport extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_create_banner_export';
    }

    public function description(): string
    {
        return 'Create an asynchronous ZIP export for generated Abyssale files.';
    }

    public function parameters(): array
    {
        return [
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'Generated banner/file IDs to export.', 'items' => ['type' => 'string']],
            'callback_url' => ['type' => 'string', 'description' => 'Optional callback URL for the export completion payload.'],
        ];
    }

    /**
     * Execute the create banner export request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createBannerExport(
            $this->requiredArray($args, 'ids', 'IDs'),
            $this->optionalString($args, 'callback_url'),
        ));
    }
}
