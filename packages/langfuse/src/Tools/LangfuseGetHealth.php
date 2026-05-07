<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Check Langfuse Public API health.
 */
class LangfuseGetHealth extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_health';
    protected const DESCRIPTION = 'Check Langfuse Public API health.';
    protected const SERVICE_METHOD = 'health';
}
