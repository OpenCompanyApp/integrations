<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get Insightly instance metadata.
 */
class InsightlyGetInstance extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_instance';
    protected string $toolDescription = 'Get Insightly instance metadata.';
    protected string $path = '/v3.1/Instance';
}
