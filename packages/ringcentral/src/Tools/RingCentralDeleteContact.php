<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a personal RingCentral address book contact.
 */
class RingCentralDeleteContact extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_delete_contact';
    }

    public function description(): string
    {
        return 'Delete a contact from the authenticated RingCentral extension\'s personal address book.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Address book contact ID.'],
        ];
    }

    /**
     * Delete a contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['contact_id'])) {
                return ToolResult::error('contact_id is required.');
            }

            return ToolResult::success($this->service->deleteContact((string) $args['contact_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
