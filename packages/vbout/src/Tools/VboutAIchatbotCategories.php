<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * AIchatbot categories tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutAIchatbotCategories extends AbstractVboutOperationTool
{
    protected const OPERATION = 'aichatbot_categories';
}