<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List installed Splunk apps.
 */
class SplunkListApps extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_list_apps'; }

    public function description(): string { return 'List installed Splunk apps.'; }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Maximum number of apps.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        ];
    }

    /**
     * List apps.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listApps(
            $this->integer($args, 'count', 100),
            $this->integer($args, 'offset', 0),
        ));
    }
}
