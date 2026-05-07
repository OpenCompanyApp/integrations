<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List AI agents.
 *
 * Executes the official Box API operation get_ai_agents.
 */
class BoxGetAiAgents extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_ai_agents';
}
