<?php

namespace OpenCompany\Integrations\Airtop\Tools;

/**
 * Query a page with pagination.
 *
 * Executes the official Airtop API operation paginated-extraction.
 */
class AirtopSessionsWindowsPaginatedExtraction extends AbstractAirtopOperationTool
{
    protected const OPERATION = 'airtop_sessions_windows_paginated_extraction';
}
