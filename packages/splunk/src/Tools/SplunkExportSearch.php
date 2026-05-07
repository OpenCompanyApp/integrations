<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Run a Splunk export search through search/jobs/export.
 */
class SplunkExportSearch extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_export_search'; }

    public function description(): string { return 'Run a Splunk export search and return the parsed or raw response.'; }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'SPL search query.'],
            'earliest_time' => ['type' => 'string', 'description' => 'Optional earliest time.'],
            'latest_time' => ['type' => 'string', 'description' => 'Optional latest time.'],
            'options' => ['type' => 'object', 'description' => 'Additional export parameters.'],
        ];
    }

    /**
     * Run an export search.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->exportSearch(
            $this->requiredString($args, 'query'),
            $this->string($args, 'earliest_time') ?: null,
            $this->string($args, 'latest_time') ?: null,
            $this->arrayArg($args, 'options'),
        ));
    }
}
