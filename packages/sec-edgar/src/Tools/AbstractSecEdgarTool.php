<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SecEdgar\SecEdgarService;

/**
 * Shared executor for SEC EDGAR tools.
 *
 * Child classes define the service method and parameter schema while this class
 * handles required argument checks and error conversion.
 */
abstract class AbstractSecEdgarTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  SecEdgarService  $service  SEC EDGAR API client.
     */
    public function __construct(protected SecEdgarService $service) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the SEC EDGAR operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            return ToolResult::success($this->dispatch($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch to the mapped service method.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function dispatch(array $args): array
    {
        return match (static::METHOD) {
            'submissions' => $this->service->submissions($args['cik']),
            'submissionFile' => $this->service->submissionFile((string) $args['file']),
            'companyFacts' => $this->service->companyFacts($args['cik']),
            'companyConcept' => $this->service->companyConcept($args['cik'], (string) $args['taxonomy'], (string) $args['tag']),
            'frames' => $this->service->frames((string) $args['taxonomy'], (string) $args['tag'], (string) $args['unit'], (string) $args['period']),
            'companyTickers' => $this->service->companyTickers(),
            'companyTickersExchange' => $this->service->companyTickersExchange(),
            'bulkArchives' => $this->service->bulkArchives(),
            default => throw new InvalidArgumentException('Unsupported SEC EDGAR operation.'),
        };
    }

    /**
     * Ensure a required argument is present and non-empty.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
