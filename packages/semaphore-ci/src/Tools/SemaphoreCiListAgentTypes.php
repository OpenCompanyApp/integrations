<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * List Semaphore self-hosted agent types.
 */
class SemaphoreCiListAgentTypes extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_list_agent_types';
    protected const DESCRIPTION = 'List Semaphore self-hosted agent types.';
    protected const METHOD = 'listAgentTypes';
}
