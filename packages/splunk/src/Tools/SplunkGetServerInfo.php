<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get Splunk server information.
 */
class SplunkGetServerInfo extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_get_server_info'; }

    public function description(): string { return 'Get Splunk server version, build, and platform information.'; }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get server information.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getServerInfo());
    }
}
