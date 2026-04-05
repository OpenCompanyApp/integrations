<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tag Intercom contacts.
 *
 * Applies a named tag to one or more contacts. Creates the tag if it does not exist.
 */
class IntercomTagContacts implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_tag_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        Tag one or more Intercom contacts with a named tag.
        Creates the tag if it does not already exist.
        Provide the tag name and an array of contact IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Tag name to apply.'],
            'contact_ids' => ['type' => 'array', 'required' => true, 'description' => 'Array of Intercom contact IDs to tag.'],
        ];
    }

    /**
     * Tag Intercom contacts with a named tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, contact_ids)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $contactIds = $args['contact_ids'] ?? [];
            if (empty($contactIds) || ! is_array($contactIds)) {
                return ToolResult::error('contact_ids is required and must be a non-empty array.');
            }

            $data = [
                'name' => $name,
                'contacts' => array_map(function (string $id): array {
                    return ['id' => $id];
                }, $contactIds),
            ];

            $result = $this->service->tagContacts($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'tagged_count' => count($contactIds),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
