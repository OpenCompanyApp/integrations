<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\TeamCity\TeamCityService;

/**
 * Shared executor for TeamCity tools.
 *
 * Child tools provide metadata and operation names while this class validates
 * required arguments, infers query/body data, and dispatches service calls.
 */
abstract class AbstractTeamCityTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  TeamCityService  $service  TeamCity API client.
     */
    public function __construct(protected TeamCityService $service) {}

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
     * Execute the TeamCity operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TeamCity integration is not configured.');
            }

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
            'getServerInfo' => $this->service->getServerInfo(),
            'listProjects' => $this->service->listProjects($this->query($args)),
            'getProject' => $this->service->getProject((string) $args['locator'], $this->query($args)),
            'createProject' => $this->service->createProject($this->payload($args)),
            'deleteProject' => $this->service->deleteProject((string) $args['locator']),
            'listBuildTypes' => $this->service->listBuildTypes($this->query($args)),
            'getBuildType' => $this->service->getBuildType((string) $args['locator'], $this->query($args)),
            'listBuildTypeBuilds' => $this->service->listBuildTypeBuilds((string) $args['locator'], $this->query($args)),
            'listBuilds' => $this->service->listBuilds($this->query($args)),
            'getBuild' => $this->service->getBuild((string) $args['locator'], $this->query($args)),
            'queueBuild' => $this->service->queueBuild($this->payload($args)),
            'cancelQueuedBuild' => $this->service->cancelQueuedBuild((string) $args['locator'], $this->payload($args)),
            'cancelBuild' => $this->service->cancelBuild((string) $args['locator'], $this->payload($args)),
            'deleteBuild' => $this->service->deleteBuild((string) $args['locator']),
            'listBuildArtifacts' => $this->service->listBuildArtifacts((string) $args['locator'], (string) ($args['path'] ?? '/'), $this->query($args)),
            'getBuildStatistics' => $this->service->getBuildStatistics((string) $args['locator'], $this->query($args)),
            'getBuildTags' => $this->service->getBuildTags((string) $args['locator'], $this->query($args)),
            'addBuildTags' => $this->service->addBuildTags((string) $args['locator'], $this->payload($args)),
            'setBuildPinInfo' => $this->service->setBuildPinInfo((string) $args['locator'], $this->payload($args)),
            'listBuildQueue' => $this->service->listBuildQueue($this->query($args)),
            'setQueuePaused' => $this->service->setQueuePaused($this->payload($args)),
            'listAgents' => $this->service->listAgents($this->query($args)),
            'getAgent' => $this->service->getAgent((string) $args['locator'], $this->query($args)),
            'listUsers' => $this->service->listUsers($this->query($args)),
            'getUser' => $this->service->getUser((string) $args['locator'], $this->query($args)),
            'listGroups' => $this->service->listGroups($this->query($args)),
            'listInvestigations' => $this->service->listInvestigations($this->query($args)),
            'listProblems' => $this->service->listProblems($this->query($args)),
            'listChanges' => $this->service->listChanges($this->query($args)),
            'listVcsRoots' => $this->service->listVcsRoots($this->query($args)),
            'apiGet' => $this->service->apiGet((string) $args['path'], $this->query($args)),
            'apiPost' => $this->service->apiPost((string) $args['path'], $this->payload($args)),
            'apiPut' => $this->service->apiPut((string) $args['path'], $this->payload($args)),
            'apiPatch' => $this->service->apiPatch((string) $args['path'], $this->payload($args)),
            'apiDelete' => $this->service->apiDelete((string) $args['path'], $this->query($args)),
            default => throw new InvalidArgumentException('Unsupported TeamCity operation.'),
        };
    }

    /**
     * Return explicit payload object or inferred write fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        if (isset($args['payload']) && is_array($args['payload'])) {
            return $args['payload'];
        }

        $payload = $args;
        foreach (['locator', 'path', 'query', 'payload'] as $key) {
            unset($payload[$key]);
        }

        return $payload;
    }

    /**
     * Return explicit query object or inferred read fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        if (isset($args['query']) && is_array($args['query'])) {
            return $args['query'];
        }

        $query = $args;
        $pathKeys = ['path', 'payload'];
        if (in_array(static::METHOD, [
            'getProject',
            'deleteProject',
            'getBuildType',
            'listBuildTypeBuilds',
            'getBuild',
            'cancelQueuedBuild',
            'cancelBuild',
            'deleteBuild',
            'listBuildArtifacts',
            'getBuildStatistics',
            'getBuildTags',
            'addBuildTags',
            'setBuildPinInfo',
            'getAgent',
            'getUser',
        ], true)) {
            $pathKeys[] = 'locator';
        }

        foreach ($pathKeys as $key) {
            unset($query[$key]);
        }

        return $query;
    }

    /**
     * Ensure a required value is present.
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
