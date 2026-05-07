<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Pipeline Get Board Guide Categories tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutPipelineGetBoardGuideCategories extends AbstractVboutOperationTool
{
    protected const OPERATION = 'pipeline_get_board_guide_categories';
}