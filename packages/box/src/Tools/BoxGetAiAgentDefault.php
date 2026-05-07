<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get AI agent default configuration.
 *
 * Executes the official Box API operation get_ai_agent_default.
 */
class BoxGetAiAgentDefault extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_ai_agent_default';
}
