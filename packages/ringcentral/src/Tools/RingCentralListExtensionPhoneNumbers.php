<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List phone numbers assigned to the authenticated RingCentral extension.
 */
class RingCentralListExtensionPhoneNumbers extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_list_extension_phone_numbers';
    }

    public function description(): string
    {
        return 'List phone numbers assigned to the authenticated RingCentral extension.';
    }

    public function parameters(): array
    {
        return [
            'usageType' => ['type' => 'string', 'description' => 'Filter by usage type.'],
            'perPage' => ['type' => 'integer', 'description' => 'Records per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Fetch extension phone numbers.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listExtensionPhoneNumbers($this->only($args, ['usageType', 'perPage', 'page'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
