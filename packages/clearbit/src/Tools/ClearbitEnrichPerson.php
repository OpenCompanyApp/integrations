<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clearbit_enrich_person
 *
 * Enriches a person record by looking up their email address via the Clearbit
 * Enrichment API (Person API). Returns social profiles, employment info,
 * location, and other demographic data when available.
 *
 * Endpoint: GET /people/find?email=…
 */
class ClearbitEnrichPerson implements Tool
{
    /**
     * @param  ClearbitService  $service  The Clearbit API service instance.
     */
    public function __construct(
        private ClearbitService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'clearbit_enrich_person';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Look up a person by email address using Clearbit. Returns social profiles, employment, location, and demographic data when available.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The email address of the person to look up (e.g., "alex@stripe.com").'],
        ];
    }

    /**
     * Execute the enrichment lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'email'.
     * @return ToolResult The enriched person data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clearbit integration is not configured.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('An email address is required.');
            }

            $result = $this->service->enrichPerson($email);

            if (empty($result)) {
                return ToolResult::success([
                    'email' => $email,
                    'found' => false,
                    'message' => 'No person data found for this email address.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
