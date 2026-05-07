<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Splunk search jobs visible to the authenticated user.
 */
class SplunkListSearchJobs extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_list_search_jobs'; }

    public function description(): string { return 'List Splunk search jobs with pagination and optional server-side filtering.'; }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Maximum number of jobs.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
            'search' => ['type' => 'string', 'description' => 'Optional server-side search filter.'],
        ];
    }

    /**
     * List search jobs.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSearchJobs(
            $this->integer($args, 'count', 100),
            $this->integer($args, 'offset', 0),
            $this->string($args, 'search') ?: null,
        ));
    }
}
