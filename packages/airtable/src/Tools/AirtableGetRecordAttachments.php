<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get attachment URLs from a specific field on an Airtable record.
 *
 * Fetches the record and extracts the attachment array from the
 * specified field, returning download URLs and metadata.
 */
class AirtableGetRecordAttachments implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_get_record_attachments';
    }

    public function description(): string
    {
        return 'Get attachment URLs from a specific attachment field on a record.';
    }

    public function parameters(): array
    {
        return [
            'base_id'   => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'     => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record ID (e.g., "recXXXXXXXXXXXX").'],
            'field'     => ['type' => 'string', 'required' => true, 'description' => 'Name of the attachment field to extract.'],
        ];
    }

    /**
     * Extract attachments from a record field.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, record_id, field)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';
            $recordId = $args['record_id'] ?? '';
            $field = $args['field'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($recordId)) {
                return ToolResult::error('record_id is required.');
            }
            if (empty($field)) {
                return ToolResult::error('field is required.');
            }

            $result = $this->service->getRecordAttachments($baseId, $table, $recordId, $field);

            $attachmentCount = count($result['attachments'] ?? []);

            return ToolResult::success([
                'record_id' => $result['recordId'],
                'field' => $result['field'],
                'attachments' => $result['attachments'],
                'count' => $attachmentCount,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
