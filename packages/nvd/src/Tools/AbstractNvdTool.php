<?php

namespace OpenCompany\Integrations\Nvd\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nvd\NvdService;

/**
 * Shared executor for NVD tools.
 *
 * Child classes define metadata while this class validates required arguments,
 * dispatches to the service, and converts API exceptions to tool errors.
 */
abstract class AbstractNvdTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  NvdService  $service  NVD API client.
     */
    public function __construct(protected NvdService $service) {}

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
     * Execute the NVD operation.
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
            'cves' => $this->service->cves($args),
            'cveById' => $this->service->cveById((string) $args['cve_id']),
            'cveHistory' => $this->service->cveHistory($args),
            'cpes' => $this->service->cpes($args),
            'cpeByNameId' => $this->service->cpeByNameId((string) $args['cpe_name_id']),
            'cpeMatch' => $this->service->cpeMatch($args),
            'cpeMatchByCriteriaId' => $this->service->cpeMatchByCriteriaId((string) $args['match_criteria_id']),
            'sources' => $this->service->sources($args),
            'sourceByIdentifier' => $this->service->sourceByIdentifier((string) $args['source_identifier']),
            default => throw new InvalidArgumentException('Unsupported NVD operation.'),
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
