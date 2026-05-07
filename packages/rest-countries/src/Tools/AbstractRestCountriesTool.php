<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RestCountries\RestCountriesService;

/**
 * Shared executor for REST Countries tools.
 *
 * Child classes provide metadata while this base class validates required
 * arguments, dispatches service calls, and converts exceptions to tool errors.
 */
abstract class AbstractRestCountriesTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  RestCountriesService  $service  REST Countries API client.
     */
    public function __construct(protected RestCountriesService $service) {}

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
     * Execute the REST Countries operation.
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
            'all' => $this->service->all($args),
            'name' => $this->service->name((string) $args['name'], $args),
            'alpha' => $this->service->alpha((string) $args['code'], $args),
            'alphaCodes' => $this->service->alphaCodes((string) $args['codes'], $args),
            'currency' => $this->service->currency((string) $args['currency'], $args),
            'language' => $this->service->language((string) $args['language'], $args),
            'capital' => $this->service->capital((string) $args['capital'], $args),
            'region' => $this->service->region((string) $args['region'], $args),
            'subregion' => $this->service->subregion((string) $args['subregion'], $args),
            'demonym' => $this->service->demonym((string) $args['demonym'], $args),
            'translation' => $this->service->translation((string) $args['translation'], $args),
            'independent' => $this->service->independent((bool) $args['status'], $args),
            default => throw new InvalidArgumentException('Unsupported REST Countries operation.'),
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
