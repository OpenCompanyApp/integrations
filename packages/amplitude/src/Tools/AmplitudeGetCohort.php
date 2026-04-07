<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeGetCohort — Retrieve a single cohort by ID.
 *
 * Calls GET /cohorts/{id} and returns the full cohort definition
 * including behavioral criteria and membership details.
 */
class AmplitudeGetCohort implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_get_cohort';
    }

    public function description(): string
    {
        return 'Retrieve a single Amplitude cohort by its ID. Returns the full cohort definition including behavioral criteria and membership size.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Amplitude cohort ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $result = $this->service->getCohort($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
