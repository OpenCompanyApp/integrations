<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenAlex\OpenAlexService;

/**
 * Get OpenAlex changefile details for a date.
 */
class OpenAlexGetChangefile implements Tool
{
    /**
     * @param  OpenAlexService  $service  OpenAlex API client.
     */
    public function __construct(private OpenAlexService $service) {}

    public function name(): string
    {
        return 'openalex_get_changefile';
    }

    public function description(): string
    {
        return 'Get OpenAlex changefile details and download links for a specific date. Changefile access may require a paid OpenAlex plan.';
    }

    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'required' => true, 'description' => 'Changefile date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Execute the OpenAlex changefile detail endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $date = (string) ($args['date'] ?? '');
            if ($date === '') {
                throw new InvalidArgumentException('date is required.');
            }

            return ToolResult::success($this->service->getChangefile($date));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
