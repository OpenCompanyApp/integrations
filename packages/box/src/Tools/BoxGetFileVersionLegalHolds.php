<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List file version legal holds.
 *
 * Executes the official Box API operation get_file_version_legal_holds.
 */
class BoxGetFileVersionLegalHolds extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_file_version_legal_holds';
}
