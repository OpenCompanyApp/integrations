<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List extensions in the authenticated RingCentral account.
 */
class RingCentralListExtensions extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_list_extensions';
    }

    public function description(): string
    {
        return 'List users and extensions in the RingCentral account with optional type/status filters and pagination.';
    }

    public function parameters(): array
    {
        return [
            'extensionType' => ['type' => 'string', 'description' => 'Filter by extension type such as User, Department, or Announcement.'],
            'status' => ['type' => 'string', 'description' => 'Filter by extension status.'],
            'perPage' => ['type' => 'integer', 'description' => 'Records per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Fetch account extensions.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listExtensions($this->only($args, ['extensionType', 'status', 'perPage', 'page'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
