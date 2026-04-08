<?php

namespace OpenCompany\Integrations\Weave\Tools;

use OpenCompany\Integrations\Weave\WeaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single patient by their unique identifier.
 *
 * Returns full patient details including demographics, contact
 * information, and any associated metadata from the Weave platform.
 */
class WeaveGetPatient implements Tool
{
    public function __construct(
        private WeaveService $service,
    ) {}

    public function name(): string
    {
        return 'weave_get_patient';
    }

    public function description(): string
    {
        return 'Retrieve a single patient by ID. Returns full patient details including demographics and contact information.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique patient identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weave integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Patient ID is required.');
            }

            $result = $this->service->getPatient($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
