<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Intercom admins.
 *
 * Returns all admins in the Intercom workspace with their IDs, names, and emails.
 */
class IntercomListAdmins implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_list_admins';
    }

    public function description(): string
    {
        return <<<'MD'
        List all admins in the Intercom workspace.
        Returns admin IDs, names, emails, and job titles.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Intercom admins.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $result = $this->service->listAdmins();

            $admins = array_map(function (array $admin): array {
                return [
                    'id' => $admin['id'] ?? '',
                    'name' => $admin['name'] ?? '',
                    'email' => $admin['email'] ?? '',
                    'job_title' => $admin['job_title'] ?? '',
                ];
            }, $result['admins'] ?? []);

            return ToolResult::success([
                'results' => $admins,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
