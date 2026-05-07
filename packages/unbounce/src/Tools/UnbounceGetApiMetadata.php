<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the Unbounce API root metadata.
 */
class UnbounceGetApiMetadata extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_get_api_metadata'; }

    public function description(): string { return 'Retrieve Unbounce API root metadata and related resource links.'; }

    public function parameters(): array { return []; }

    /**
     * Get API metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getApiMetadata());
    }
}
