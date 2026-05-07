<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Extract metadata (freeform).
 *
 * Executes the official Box API operation post_ai_extract.
 */
class BoxPostAiExtract extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_ai_extract';
}
