<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the status of an Abyssale design duplication request.
 */
class AbyssaleGetDuplicationRequest extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_get_duplication_request';
    }

    public function description(): string
    {
        return 'Get the status of a workspace-template duplication request.';
    }

    public function parameters(): array
    {
        return [
            'duplicate_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Duplication request UUID.'],
        ];
    }

    /**
     * Execute the get duplication request status call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getDuplicationRequest(
            $this->requiredString($args, 'duplicate_request_id', 'Duplicate request ID'),
        ));
    }
}
