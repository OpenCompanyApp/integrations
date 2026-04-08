<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all reports in the authenticated Wufoo account.
 *
 * Calls GET /reports.json on the Wufoo API and returns an array of report
 * objects including report identifiers, names, and associated form details.
 */
class WufooListReports implements Tool
{
    /**
     * Create a new WufooListReports tool instance.
     *
     * @param  WufooService  $service  The Wufoo API service instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wufoo_list_reports';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all reports in your Wufoo account. Returns report identifiers, names, descriptions, and the forms they are associated with.';
    }

    /**
     * Get the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> The parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list reports operation.
     *
     * @param  array<string, mixed>  $args  The tool arguments (none required).
     * @return ToolResult The result containing the list of reports or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $result = $this->service->listReports();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
