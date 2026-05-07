<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative Splunk services API path with POST.
 */
class SplunkApiPost extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_api_post'; }

    public function description(): string { return 'Call a safe relative Splunk services path with POST form parameters.'; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path under /services.'],
            'payload' => ['type' => 'object', 'description' => 'Form body parameters.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Call a POST path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPost(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'payload'),
            $this->arrayArg($args, 'params'),
        ));
    }
}
