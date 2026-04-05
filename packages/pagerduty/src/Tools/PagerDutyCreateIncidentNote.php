<?php

namespace OpenCompany\Integrations\PagerDuty\Tools;

use OpenCompany\Integrations\PagerDuty\PagerDutyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a note on a PagerDuty incident.
 *
 * Adds a text note to the incident timeline. Notes are visible to all
 * responders and stakeholders with access to the incident.
 */
class PagerDutyCreateIncidentNote implements Tool
{
    /**
     * @param  PagerDutyService  $service  The PagerDuty API client
     */
    public function __construct(
        private PagerDutyService $service,
    ) {}

    public function name(): string
    {
        return 'pagerduty_create_incident_note';
    }

    public function description(): string
    {
        return <<<'MD'
        Add a note to a PagerDuty incident.
        Notes appear on the incident timeline and are visible to all responders.
        Use notes to add context, status updates, or action items.
        MD;
    }

    public function parameters(): array
    {
        return [
            'incident_id' => ['type' => 'string', 'required' => true, 'description' => 'PagerDuty incident ID to add the note to.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The note content text.'],
        ];
    }

    /**
     * Create a note on a PagerDuty incident.
     *
     * @param  array<string, mixed>  $args  Tool arguments (incident_id, content)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('PagerDuty integration is not configured.');
            }

            $incidentId = $args['incident_id'] ?? '';
            if (empty($incidentId)) {
                return ToolResult::error('incident_id is required.');
            }

            $content = $args['content'] ?? '';
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $result = $this->service->createIncidentNote($incidentId, $content);
            $note = $result['note'] ?? $result;

            return ToolResult::success([
                'id' => $note['id'] ?? '',
                'content' => $note['content'] ?? $content,
                'created_at' => $note['created_at'] ?? null,
                'user' => [
                    'id' => $note['user']['id'] ?? null,
                    'name' => $note['user']['summary'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
