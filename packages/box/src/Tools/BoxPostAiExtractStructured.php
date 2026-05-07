<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Extract metadata (structured).
 *
 * Executes the official Box API operation post_ai_extract_structured.
 */
class BoxPostAiExtractStructured extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_ai_extract_structured';
}
