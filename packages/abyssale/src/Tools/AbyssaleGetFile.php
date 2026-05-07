<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a generated Abyssale file by banner ID.
 */
class AbyssaleGetFile extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_get_file';
    }

    public function description(): string
    {
        return 'Get a generated Abyssale file by banner ID.';
    }

    public function parameters(): array
    {
        return [
            'banner_id' => ['type' => 'string', 'required' => true, 'description' => 'The generated banner/file UUID.'],
        ];
    }

    /**
     * Execute the get file request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getFile(
            $this->requiredString($args, 'banner_id', 'Banner ID'),
        ));
    }
}
