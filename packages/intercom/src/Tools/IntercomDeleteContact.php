<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete an Intercom contact by ID.
 *
 * Permanently removes the contact from Intercom.
 */
class IntercomDeleteContact implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_delete_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete an Intercom contact by ID.
        Permanently removes the contact from Intercom.
        This action cannot be undone.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Intercom contact ID to delete.'],
        ];
    }

    /**
     * Delete an Intercom contact permanently by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $id = $args['contact_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('contact_id is required.');
            }

            $this->service->deleteContact($id);

            return ToolResult::success([
                'id' => $id,
                'deleted' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
