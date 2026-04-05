<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a note on an Intercom contact.
 *
 * Adds a note to the specified contact's profile.
 */
class IntercomCreateNote implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_create_note';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a note on an Intercom contact.
        The note is attached to the contact's profile and visible to admins.
        Provide the contact ID and the note body.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Intercom contact ID to attach the note to.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Note body text.'],
        ];
    }

    /**
     * Create a note on an Intercom contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id, body)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $contactId = $args['contact_id'] ?? '';
            if (empty($contactId)) {
                return ToolResult::error('contact_id is required.');
            }

            $body = $args['body'] ?? '';
            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $result = $this->service->createNote([
                'contact_id' => $contactId,
                'body' => $body,
            ]);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'contact_id' => $contactId,
                'created_at' => $result['created_at'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
