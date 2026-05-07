<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative Splunk services API path with GET.
 */
class SplunkApiGet extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_api_get'; }

    public function description(): string { return 'Call a safe relative Splunk services path with GET.'; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path under /services.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Call a GET path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiGet(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'params'),
        ));
    }
}
