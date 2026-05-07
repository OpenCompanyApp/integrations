<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Webex person by ID.
 */
class WebexGetPerson extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_get_person';
    }

    public function description(): string
    {
        return 'Get a Webex person profile by person ID.';
    }

    public function parameters(): array
    {
        return [
            'person_id' => ['type' => 'string', 'required' => true, 'description' => 'Person ID.'],
        ];
    }

    /**
     * Fetch one person.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['person_id'])) {
                return ToolResult::error('person_id is required.');
            }

            return ToolResult::success($this->service->getPerson((string) $args['person_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
