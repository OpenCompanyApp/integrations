<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * List Semaphore self-hosted agents.
 */
class SemaphoreCiListAgents extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_list_agents';
    protected const DESCRIPTION = 'List Semaphore self-hosted agents with optional agent_type, page_size, and cursor.';
    protected const METHOD = 'listAgents';
    protected const PARAMETERS = ['agent_type' => ['type' => 'string', 'description' => 'Agent type filter.'], 'page_size' => ['type' => 'integer', 'description' => 'Page size.'], 'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'], 'query' => ['type' => 'object', 'description' => 'Additional query parameters.']];
}
