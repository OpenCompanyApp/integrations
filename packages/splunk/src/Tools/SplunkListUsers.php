<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Splunk users.
 */
class SplunkListUsers extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_list_users'; }

    public function description(): string { return 'List Splunk users visible to the authenticated token.'; }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Maximum number of users.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        ];
    }

    /**
     * List users.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listUsers(
            $this->integer($args, 'count', 100),
            $this->integer($args, 'offset', 0),
        ));
    }
}
