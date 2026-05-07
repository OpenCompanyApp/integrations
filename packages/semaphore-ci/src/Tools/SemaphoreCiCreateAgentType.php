<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Create a Semaphore self-hosted agent type.
 */
class SemaphoreCiCreateAgentType extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_create_agent_type';
    protected const DESCRIPTION = 'Create a Semaphore self-hosted agent type. Payload follows the official metadata/spec shape.';
    protected const METHOD = 'createAgentType';
    protected const REQUIRED = ['payload'];
    protected const PARAMETERS = ['payload' => ['type' => 'object', 'required' => true, 'description' => 'Agent type payload.']];
}
