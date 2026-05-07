<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClinicalTrialsGov\ClinicalTrialsGovService;

/**
 * Shared executor for ClinicalTrials.gov API v2 tools.
 *
 * Child classes define method dispatch, parameters, defaults, and required
 * arguments while this class handles validation and error conversion.
 */
abstract class AbstractClinicalTrialsGovTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const DEFAULTS = [];
    protected const REQUIRED = [];

    /**
     * @param  ClinicalTrialsGovService  $service  ClinicalTrials.gov API v2 client.
     */
    public function __construct(protected ClinicalTrialsGovService $service) {}

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
        return static::PARAMETERS + [
            'extra' => ['type' => 'object', 'required' => false, 'description' => 'Additional official ClinicalTrials.gov API v2 query parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the ClinicalTrials.gov operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            $extra = isset($args['extra']) && is_array($args['extra']) ? $args['extra'] : [];
            unset($args['extra']);
            $params = array_merge(static::DEFAULTS, $extra, $args);

            return ToolResult::success($this->dispatch($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch to the service method represented by the tool.
     *
     * @param  array<string, mixed>  $params  Normalized tool parameters.
     * @return array<string, mixed>
     */
    private function dispatch(array $params): array
    {
        return match (static::METHOD) {
            'listStudies' => $this->service->listStudies($params),
            'fetchStudy' => $this->fetchStudy($params),
            'metadata' => $this->service->metadata($params),
            'searchAreas' => $this->service->searchAreas(),
            'enums' => $this->service->enums(),
            'sizeStats' => $this->service->sizeStats(),
            'fieldValuesStats' => $this->service->fieldValuesStats($params),
            'fieldSizesStats' => $this->service->fieldSizesStats($params),
            'version' => $this->service->version(),
            default => throw new InvalidArgumentException('Unsupported ClinicalTrials.gov operation.'),
        };
    }

    /**
     * Fetch a single study after removing the path parameter from query options.
     *
     * @param  array<string, mixed>  $params  Tool parameters.
     * @return array<string, mixed>
     */
    private function fetchStudy(array $params): array
    {
        $nctId = (string) $params['nctId'];
        unset($params['nctId']);

        return $this->service->fetchStudy($nctId, $params);
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
