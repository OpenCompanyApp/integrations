<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * AIchatbot tags tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutAIchatbotTags extends AbstractVboutOperationTool
{
    protected const OPERATION = 'aichatbot_tags';
}