<?php

namespace OpenCompany\Integrations\Plivo\Tools;

use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving details of a specific phone number from the Plivo API.
 *
 * Returns number details including alias, application, service type, and sub-account.
 *
 * @see https://www.plivo.com/docs/numbers/api/number#get-a-number
 */
class PlivoGetNumber implements Tool
{
    /**
     * Create a new PlivoGetNumber tool instance.
     *
     * @param  PlivoService  $service  The Plivo API service instance.
     */
    public function __construct(
        private PlivoService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'plivo_get_number';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Retrieve details of a specific phone number on your Plivo account by its number (e.g., "+14155552671"). Returns alias, application, service type, and other number properties.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'number' => ['type' => 'string', 'required' => true, 'description' => 'The phone number to retrieve (e.g., "+14155552671").'],
        ];
    }

    /**
     * Execute the get number tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing the phone number.
     * @return ToolResult The result containing number details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plivo integration is not configured.');
            }

            $result = $this->service->getNumber($args['number']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
