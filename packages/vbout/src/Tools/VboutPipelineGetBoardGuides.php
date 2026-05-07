<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Pipeline Get Board Guides tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutPipelineGetBoardGuides extends AbstractVboutOperationTool
{
    protected const OPERATION = 'pipeline_get_board_guides';
}